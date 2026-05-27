<?php

namespace App\Console\Commands;

use App\Models\Dictionary;
use App\Models\DictionaryMeaning;
use App\Models\DictionaryDefinition;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportDictionaryMeanings extends Command
{
    protected $signature = 'dictionary:import-meanings';

    protected $description = 'Import meanings and definitions';

    public function handle()
    {
        set_time_limit(0);

        ini_set('memory_limit', '-1');

        /*
        |--------------------------------------------------------------------------
        | Clear old data
        |--------------------------------------------------------------------------
        */

        DictionaryDefinition::truncate();

        DictionaryMeaning::truncate();

        $this->warn('Old meanings and definitions deleted.');

        /*
        |--------------------------------------------------------------------------
        | Get dictionaries
        |--------------------------------------------------------------------------
        */

        $dictionaries = Dictionary::query()
            ->select(['id', 'word'])
            ->orderBy('id')
            ->get();

        $total = $dictionaries->count();

        $this->info("Total dictionaries: {$total}");

        $savedMeanings = 0;
        $savedDefinitions = 0;
        $failed = 0;

        foreach ($dictionaries as $index => $dictionary) {

            $current = $index + 1;

            $word = strtolower(trim($dictionary->word));

            $this->line('---------------------------------------');

            $this->info("[{$current}/{$total}] {$word}");

            try {

                $response = Http::timeout(30)->get(
                    'https://api.dictionaryapi.dev/api/v2/entries/en/' .
                    urlencode($word)
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
                | All meanings
                |--------------------------------------------------------------------------
                */

                $meanings = collect($dictionaryData)
                    ->pluck('meanings')
                    ->flatten(1)
                    ->values();

                foreach ($meanings as $meaningItem) {

                    /*
                    |--------------------------------------------------------------------------
                    | Save meaning
                    |--------------------------------------------------------------------------
                    */

                    $meaning = DictionaryMeaning::create([
                        'dictionary_id' => $dictionary->id,
                        'part_of_speech' => $meaningItem['partOfSpeech'] ?? null,
                    ]);

                    $savedMeanings++;

                    /*
                    |--------------------------------------------------------------------------
                    | Save definitions
                    |--------------------------------------------------------------------------
                    */

                    $definitions = $meaningItem['definitions'] ?? [];

                    foreach ($definitions as $definitionItem) {

                        DictionaryDefinition::create([
                            'dictionary_meaning_id' => $meaning->id,

                            'definition' =>
                                $definitionItem['definition'] ?? null,

                            'example' =>
                                $definitionItem['example'] ?? null,
                        ]);

                        $savedDefinitions++;
                    }
                }

                $this->info("Meanings imported.");

            } catch (\Exception $e) {

                $failed++;

                $this->error($e->getMessage());
            }

            usleep(300000);
        }

        $this->newLine();

        $this->info('==========================');

        $this->info('MEANINGS IMPORT FINISHED');

        $this->info('==========================');

        $this->line("Saved meanings: {$savedMeanings}");

        $this->line("Saved definitions: {$savedDefinitions}");

        $this->line("Failed: {$failed}");

        $this->line("Total dictionaries: {$total}");

        return Command::SUCCESS;
    }
}