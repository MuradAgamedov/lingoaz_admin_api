<?php

namespace App\Console\Commands;

use App\Models\Dictionary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportDictionaryWords extends Command
{
    protected $signature = 'dictionary:import';

    protected $description = 'Import only english words';

    public function handle()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        Dictionary::truncate();

        $wordListUrl = 'https://raw.githubusercontent.com/aparrish/wordfreq-en-25000/main/wordfreq-en-25000-log.json';

        $this->info('Word list loading...');

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0',
            'Accept' => 'application/json',
        ])
            ->timeout(120)
            ->retry(5, 2000)
            ->get($wordListUrl);

        if (!$response->successful()) {
            $this->error('Word list failed.');
            return Command::FAILURE;
        }

        $words = $response->json();

        if (!is_array($words)) {
            $this->error('Invalid word list response.');
            return Command::FAILURE;
        }

        $total = count($words);

        $this->info("TOTAL WORDS: {$total}");

        $saved = 0;
        $failed = 0;

        foreach ($words as $index => $item) {
            $current = $index + 1;

            $word = is_array($item)
                ? strtolower(trim($item[0] ?? ''))
                : strtolower(trim($item));

            if (!$word) {
                $failed++;
                continue;
            }

            try {
                Dictionary::updateOrCreate(
                    ['word' => $word],
                    [
                        'user_id' => 1,
                        'phonetic' => null,
                        'audio_urls' => [],
                        'translation' => null,
                        'part_of_speech' => null,
                        'definition' => null,
                        'example' => null,
                        'phonetics' => [],
                        'meanings' => [],
                    ]
                );

                $saved++;

                $this->info("[{$current}/{$total}] Saved: {$word}");

            } catch (\Exception $e) {
                $failed++;

                $this->error("[{$current}/{$total}] Failed: {$word}");
                $this->error($e->getMessage());
            }
        }

        $this->newLine();

        $this->info('==========================');
        $this->info('IMPORT FINISHED');
        $this->info('==========================');

        $this->line("Saved: {$saved}");
        $this->line("Failed: {$failed}");
        $this->line("Total: {$total}");

        return Command::SUCCESS;
    }
}