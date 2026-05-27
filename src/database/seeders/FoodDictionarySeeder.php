<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class FoodDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Food')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Food',
            ]);
        }

        $words = [
            ['word' => 'a sandwich', 'translation' => 'sendviç'],
            ['word' => 'toast', 'translation' => 'qızardılmış çörək'],
            ['word' => 'a cake', 'translation' => 'tort'],
            ['word' => 'a bun', 'translation' => 'bulka'],
            ['word' => 'tea', 'translation' => 'çay'],
            ['word' => 'coffee', 'translation' => 'qəhvə'],
            ['word' => 'sugar', 'translation' => 'şəkər'],
            ['word' => 'porridge', 'translation' => 'sıyıq'],
            ['word' => 'cheese', 'translation' => 'pendir'],
            ['word' => 'sausage', 'translation' => 'kolbasa'],
            ['word' => 'sausages', 'translation' => 'sosiska'],
            ['word' => 'salt', 'translation' => 'duz'],
            ['word' => 'pepper', 'translation' => 'istiot'],
            ['word' => 'salad', 'translation' => 'salat'],
            ['word' => 'soup', 'translation' => 'şorba'],
            ['word' => 'meat', 'translation' => 'ət'],
            ['word' => 'chicken', 'translation' => 'toyuq'],
            ['word' => 'fish', 'translation' => 'balıq'],
            ['word' => 'cutlets', 'translation' => 'kotlet'],
            ['word' => 'potatoes', 'translation' => 'kartof'],
            ['word' => 'tomatoes', 'translation' => 'pomidor'],
            ['word' => 'vegetables', 'translation' => 'tərəvəzlər'],
            ['word' => 'bread', 'translation' => 'çörək'],
            ['word' => 'butter', 'translation' => 'kərə yağı'],
            ['word' => 'a drink', 'translation' => 'içki'],
            ['word' => 'milk', 'translation' => 'süd'],
            ['word' => 'juice', 'translation' => 'şirə'],
            ['word' => 'coca-cola', 'translation' => 'koka-kola'],
            ['word' => 'mineral water', 'translation' => 'mineral su'],
            ['word' => 'an ice-cream', 'translation' => 'dondurma'],
            ['word' => 'fruit', 'translation' => 'meyvə'],

            ['word' => 'have for breakfast', 'translation' => 'səhər yeməyində yemək'],
            ['word' => 'have light breakfast', 'translation' => 'yüngül səhər yeməyi etmək'],
            ['word' => 'have big breakfast', 'translation' => 'bol səhər yeməyi etmək'],
            ['word' => 'have no breakfast at all', 'translation' => 'ümumiyyətlə səhər yeməyi yeməmək'],
            ['word' => 'have for lunch', 'translation' => 'naharda yemək'],
            ['word' => 'have for dinner', 'translation' => 'şam yeməyində yemək'],
            ['word' => 'have for supper', 'translation' => 'gec axşam yeməyində yemək'],
            ['word' => 'have coffee instead of tea', 'translation' => 'çay əvəzinə qəhvə içmək'],

            ['word' => 'be hungry', 'translation' => 'ac olmaq'],
            ['word' => 'feel hungry', 'translation' => 'ac hiss etmək'],
            ['word' => 'be thirsty', 'translation' => 'susuz olmaq'],

            ['word' => 'drink', 'translation' => 'içmək'],
            ['word' => 'eat', 'translation' => 'yemək'],
            ['word' => 'cook', 'translation' => 'bişirmək'],
            ['word' => 'make a cup of tea', 'translation' => 'bir fincan çay hazırlamaq'],
            ['word' => 'wash up', 'translation' => 'qab yumaq'],
            ['word' => 'wash hands before a meal', 'translation' => 'yeməkdən əvvəl əlləri yumaq'],
            ['word' => 'be ready', 'translation' => 'hazır olmaq'],
            ['word' => 'be over', 'translation' => 'bitmək'],
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
