<?php

namespace App\Console\Commands;

use App\Models\Dictionary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RefreshDictionaryAudios extends Command
{
    protected $signature = 'dictionary:refresh-audios';

    protected $description = 'Refresh all dictionary audio files';

    public function handle()
    {
        set_time_limit(0);

        ini_set('memory_limit', '-1');

        /*
        |--------------------------------------------------------------------------
        | Clear audio_urls field
        |--------------------------------------------------------------------------
        */

        Dictionary::query()->update([
            'audio_urls' => json_encode([]),
        ]);

        $this->warn('All audio_urls fields cleared.');

        /*
        |--------------------------------------------------------------------------
        | Clear dictionary folder
        |--------------------------------------------------------------------------
        */

        Storage::disk('public')->deleteDirectory('dictionary');

        Storage::disk('public')->makeDirectory('dictionary');

        $this->warn('Dictionary audio folder cleared.');

        /*
        |--------------------------------------------------------------------------
        | Get all words
        |--------------------------------------------------------------------------
        */

        $dictionaries = Dictionary::query()
            ->select(['id', 'word'])
            ->orderBy('id')
            ->get();

        $total = $dictionaries->count();

        $this->info("Total words: {$total}");

        $updated = 0;
        $failed = 0;

        foreach ($dictionaries as $index => $dictionary) {

            $current = $index + 1;

            $word = strtolower(trim($dictionary->word));

            $this->line('---------------------------------------');

            $this->info("[{$current}/{$total}] {$word}");

            try {

                $response = Http::timeout(30)->get(
                    'https://api.dictionaryapi.dev/api/v2/entries/en/' . urlencode($word)
                );

                if (!$response->successful()) {

                    $this->error("Dictionary API failed: {$word}");

                    $failed++;

                    continue;
                }

                $dictionaryData = $response->json();

                if (!is_array($dictionaryData) || empty($dictionaryData)) {

                    $this->error("No dictionary data: {$word}");

                    $failed++;

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Collect all audio urls from all response entries
                |--------------------------------------------------------------------------
                */

                $audioUrls = collect($dictionaryData)
                    ->pluck('phonetics')
                    ->flatten(1)
                    ->pluck('audio')
                    ->filter(fn ($audio) => is_string($audio) && trim($audio) !== '')
                    ->unique()
                    ->values();

                /*
                |--------------------------------------------------------------------------
                | No Audio
                |--------------------------------------------------------------------------
                */

                if ($audioUrls->isEmpty()) {

                    $this->warn("No audio found: {$word}");

                    Dictionary::where('id', $dictionary->id)->update([
                        'audio_urls' => json_encode([]),
                    ]);

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Download all audios (retry up to 3 times per URL)
                |--------------------------------------------------------------------------
                */

                $audioPaths = [];

                foreach ($audioUrls as $audioIndex => $audioUrl) {

                    $downloaded = false;

                    for ($attempt = 1; $attempt <= 3; $attempt++) {

                        try {

                            $audioResponse = Http::timeout(60)->get($audioUrl);

                            if (!$audioResponse->successful()) {

                                $this->warn("Attempt {$attempt}/3 failed [{$audioUrl}]");

                                usleep(500000);

                                continue;
                            }

                            $fileName = Str::slug($word) . '-' . ($audioIndex + 1) . '.mp3';

                            $audioPath = 'dictionary/' . $fileName;

                            Storage::disk('public')->put(
                                $audioPath,
                                $audioResponse->body()
                            );

                            $audioPaths[] = $audioPath;

                            $downloaded = true;

                            break;

                        } catch (\Exception $e) {

                            $this->warn("Attempt {$attempt}/3 exception [{$word}]: {$e->getMessage()}");

                            usleep(500000);
                        }
                    }

                    if (!$downloaded) {

                        $this->error("All 3 attempts failed for audio: {$audioUrl}");
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Save audio paths
                |--------------------------------------------------------------------------
                */

                Dictionary::where('id', $dictionary->id)->update([
                    'audio_urls' => json_encode($audioPaths),
                ]);

                $updated++;

                $remaining = $total - $current;

                $this->info("Updated: {$word}");

                $this->line("Audios count: " . count($audioPaths));

                $this->line("Remaining: {$remaining}");

            } catch (\Exception $e) {

                $failed++;

                $this->error($e->getMessage());
            }

            usleep(300000);
        }

        $this->newLine();

        $this->info('==========================');

        $this->info('AUDIO REFRESH FINISHED');

        $this->info('==========================');

        $this->line("Updated: {$updated}");

        $this->line("Failed: {$failed}");

        $this->line("Total: {$total}");

        return Command::SUCCESS;
    }
}