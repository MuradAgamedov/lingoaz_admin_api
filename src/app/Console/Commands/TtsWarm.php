<?php

namespace App\Console\Commands;

use App\Models\Word;
use App\Services\TtsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TtsWarm extends Command
{
    protected $signature = 'tts:warm {--voice=* : Voices to generate (default: all)}';

    protected $description = 'Pre-generate Italian audio for every word in the dictionary';

    public function handle(TtsService $tts): int
    {
        $voices = $this->option('voice') ?: array_keys(TtsService::VOICES);
        $texts = Word::query()->distinct()->pluck('original');
        $failures = 0;

        foreach ($voices as $voice) {
            $made = $skipped = $failed = 0;

            foreach ($texts as $text) {
                $existed = Storage::disk('public')->exists($tts->relativePath($text, $voice));

                if ($tts->ensure($text, $voice) === null) {
                    $failed++;
                    $this->warn("[{$voice}] failed: {$text}");
                } elseif ($existed) {
                    $skipped++;
                } else {
                    $made++;
                }
            }

            $failures += $failed;
            $this->info("[{$voice}] generated {$made}, already cached {$skipped}, failed {$failed}");
        }

        return $failures > 0 ? self::FAILURE : self::SUCCESS;
    }
}
