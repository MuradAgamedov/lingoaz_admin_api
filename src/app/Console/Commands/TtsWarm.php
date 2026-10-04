<?php

namespace App\Console\Commands;

use App\Models\Word;
use App\Services\TtsService;
use Illuminate\Console\Command;

class TtsWarm extends Command
{
    protected $signature = 'tts:warm';

    protected $description = 'Pre-generate Italian audio for every word in the dictionary';

    public function handle(TtsService $tts): int
    {
        $texts = Word::query()->distinct()->pluck('original');
        $made = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($texts as $text) {
            $existed = \Storage::disk('public')->exists($tts->relativePath($text));

            if ($tts->ensure($text) === null) {
                $failed++;
                $this->warn("failed: {$text}");
            } elseif ($existed) {
                $skipped++;
            } else {
                $made++;
            }
        }

        $this->info("generated {$made}, already cached {$skipped}, failed {$failed}");

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }
}
