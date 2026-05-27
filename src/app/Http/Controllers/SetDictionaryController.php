<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Support\Facades\Http;

class SetDictionaryController extends Controller
{
    public function importWords()
    {
        $blockedWords = [];

        $json = file_get_contents(
            asset('storage/wordfreq-en-25000-log.json')
        );

        $words = json_decode($json, true);

        foreach (array_slice($words, 0, 100) as $index => $item) {

            $word = strtolower(trim($item[0]));
            $frequency = $item[1];

            if (in_array($word, $blockedWords)) {
                continue;
            }

            $exists = Word::where('word', $word)->exists();

            if ($exists) {
                continue;
            }

            try {

                $response = Http::timeout(15)
                    ->get(
                        "https://api.dictionaryapi.dev/api/v2/entries/en/" .
                        urlencode($word)
                    );

                if (!$response->successful()) {
                    continue;
                }

                $data = $response->json();

                if (!isset($data[0])) {
                    continue;
                }

                $entry = $data[0];

                $phonetic = $entry['phonetic'] ?? null;

                $audio = null;

                if (isset($entry['phonetics'])) {

                    foreach ($entry['phonetics'] as $phoneticItem) {

                        if (!empty($phoneticItem['audio'])) {
                            $audio = $phoneticItem['audio'];
                            break;
                        }
                    }
                }

                $definition = null;
                $example = null;
                $partOfSpeech = null;

                if (isset($entry['meanings'][0])) {

                    $meaning = $entry['meanings'][0];

                    $partOfSpeech = $meaning['partOfSpeech'] ?? null;

                    if (isset($meaning['definitions'][0])) {

                        $definition = $meaning['definitions'][0]['definition'] ?? null;

                        $example = $meaning['definitions'][0]['example'] ?? null;
                    }
                }

                dd([
                    'word' => $word,
                    'frequency_order' => $index + 1,
                    'frequency_score' => $frequency,
                    'phonetic' => $phonetic,
                    'audio_url' => $audio,
                    'definition' => $definition,
                    'example' => $example,
                    'part_of_speech' => $partOfSpeech,
                ]);

            } catch (\Exception $e) {

                dd($e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
        ]);
    }
}