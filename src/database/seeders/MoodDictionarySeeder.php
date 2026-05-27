<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class MoodDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Mood')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Mood',
            ]);
        }

        $words = [
            ['word' => 'feeling', 'translation' => 'hiss'],
            ['word' => 'mood', 'translation' => 'əhval'],

            ['word' => 'glad', 'translation' => 'sevincli'],
            ['word' => 'sad', 'translation' => 'kədərli'],
            ['word' => 'upset', 'translation' => 'məyus'],
            ['word' => 'happy', 'translation' => 'xoşbəxt'],
            ['word' => 'unhappy', 'translation' => 'bədbəxt'],
            ['word' => 'angry', 'translation' => 'qəzəbli'],
            ['word' => 'energetic', 'translation' => 'enerjili'],

            ['word' => 'excited', 'translation' => 'həyəcanlı'],
            ['word' => 'bored', 'translation' => 'darıxmış'],
            ['word' => 'tired', 'translation' => 'yorğun'],
            ['word' => 'scared', 'translation' => 'qorxmuş'],
            ['word' => 'worried', 'translation' => 'narahat'],
            ['word' => 'puzzled', 'translation' => 'çaşqın'],
            ['word' => 'interested', 'translation' => 'maraqlanan'],
        ];

        foreach ($words as $item) {
            $dictionary = Dictionary::updateOrCreate(
                ['word' => $item['word']],
                ['translation' => $item['translation']]
            );

            $dictionary->categories()->syncWithoutDetaching([
                $category->id,
            ]);
        }
    }
}
