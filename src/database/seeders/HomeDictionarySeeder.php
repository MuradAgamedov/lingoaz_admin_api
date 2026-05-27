<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class HomeDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Home')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Home',
            ]);
        }

        $words = [

            ['word' => 'home', 'translation' => 'ev'],
            ['word' => 'my place', 'translation' => 'mənim evim'],
            ['word' => 'house', 'translation' => 'ev'],
            ['word' => 'country house', 'translation' => 'kənd evi'],
            ['word' => 'in the country', 'translation' => 'şəhərdən kənarda'],
            ['word' => 'flat', 'translation' => 'mənzil'],
            ['word' => 'in the city', 'translation' => 'şəhərdə'],

            ['word' => 'room', 'translation' => 'otaq'],
            ['word' => 'the walls', 'translation' => 'divarlar'],
            ['word' => 'the floor', 'translation' => 'döşəmə'],
            ['word' => 'the ceiling', 'translation' => 'tavan'],
            ['word' => 'door', 'translation' => 'qapı'],
            ['word' => 'window', 'translation' => 'pəncərə'],
            ['word' => 'corner', 'translation' => 'künc'],

            ['word' => 'hall', 'translation' => 'dəhliz'],
            ['word' => 'living room', 'translation' => 'qonaq otağı'],
            ['word' => 'dining room', 'translation' => 'yemək otağı'],
            ['word' => 'bedroom', 'translation' => 'yataq otağı'],
            ['word' => 'bathroom', 'translation' => 'hamam otağı'],
            ['word' => 'kitchen', 'translation' => 'mətbəx'],
            ['word' => 'toilet', 'translation' => 'tualet'],
            ['word' => 'closet', 'translation' => 'anbar otağı'],

            // Expressions
            ['word' => 'at home', 'translation' => 'evdə'],
            ['word' => 'at my place', 'translation' => 'məndə / mənim evimdə'],
            ['word' => 'go home', 'translation' => 'evə getmək'],
            ['word' => 'come home', 'translation' => 'evə gəlmək'],
            ['word' => 'leave home', 'translation' => 'evdən çıxmaq'],

            // Additional text words
            ['word' => 'garage', 'translation' => 'qaraj'],
            ['word' => 'modern', 'translation' => 'müasir'],
            ['word' => 'upstairs', 'translation' => 'yuxarı mərtəbədə'],
            ['word' => 'own', 'translation' => 'öz'],
            ['word' => 'another', 'translation' => 'başqa'],
            ['word' => 'apartment', 'translation' => 'mənzil'],
            ['word' => 'for vacation', 'translation' => 'tətil üçün'],
            ['word' => 'near the sea', 'translation' => 'dəniz yaxınlığında'],
            ['word' => 'in the mountains', 'translation' => 'dağlarda'],
            ['word' => 'weekend', 'translation' => 'həftəsonu'],
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
