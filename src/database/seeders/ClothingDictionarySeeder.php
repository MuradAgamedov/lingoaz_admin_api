<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class ClothingDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Clothing')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Clothing',
            ]);
        }

        $words = [
            ['word' => 'jeans', 'translation' => 'cins şalvar'],
            ['word' => 'trousers', 'translation' => 'şalvar'],
            ['word' => 'shorts', 'translation' => 'şort'],
            ['word' => 'dress', 'translation' => 'paltar'],
            ['word' => 'jacket', 'translation' => 'gödəkçə'],
            ['word' => 'coat', 'translation' => 'palto'],
            ['word' => 'T-shirt', 'translation' => 'futbolka'],
            ['word' => 'shirt', 'translation' => 'köynək'],
            ['word' => 'skirt', 'translation' => 'ətək'],
            ['word' => 'blouse', 'translation' => 'bluza'],
            ['word' => 'sweater', 'translation' => 'sviter'],
            ['word' => 'cap', 'translation' => 'kepka'],
            ['word' => 'scarf', 'translation' => 'şərf'],
            ['word' => 'shoes', 'translation' => 'ayaqqabı'],
            ['word' => 'boots', 'translation' => 'çəkmə'],

            ['word' => 'wear', 'translation' => 'geymək'],
            ['word' => 'put on', 'translation' => 'əyninə geyinmək'],
            ['word' => 'take off', 'translation' => 'çıxarmaq'],
            ['word' => 'dress', 'translation' => 'geyinmək'],
            ['word' => 'undress', 'translation' => 'soymaq / paltarını çıxarmaq'],

            ['word' => 'overall', 'translation' => 'kombinezon'],
            ['word' => 'laces', 'translation' => 'bağcıqlar'],
            ['word' => 'belt', 'translation' => 'kəmər'],
            ['word' => 'button', 'translation' => 'düymə'],
            ['word' => 'hat', 'translation' => 'şlyapa'],
            ['word' => 'socks', 'translation' => 'corab'],
            ['word' => 'sandals', 'translation' => 'sandal'],

            ['word' => 'mittens', 'translation' => 'əlcək'],
            ['word' => 'tights', 'translation' => 'kalqotka'],
            ['word' => 'high boots', 'translation' => 'uzunboğaz çəkmə'],

            ['word' => 'casual clothes', 'translation' => 'rahat geyim'],
            ['word' => 'fashionable clothes', 'translation' => 'dəbli geyim'],
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
