<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class FamilyAndFriendsDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Family and Friends')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Family and Friends',
            ]);
        }

        $words = [
            ['word' => 'father', 'translation' => 'ata'],
            ['word' => 'mother', 'translation' => 'ana'],
            ['word' => 'parents', 'translation' => 'valideynlər'],
            ['word' => 'son', 'translation' => 'oğul'],
            ['word' => 'daughter', 'translation' => 'qız'],
            ['word' => 'sister', 'translation' => 'bacı'],
            ['word' => 'brother', 'translation' => 'qardaş'],
            ['word' => 'cousin', 'translation' => 'əmioğlu / xalaoğlu / bibioğlu / dayıoğlu'],
            ['word' => 'sibling', 'translation' => 'bacı və ya qardaş'],
            ['word' => 'second cousin', 'translation' => 'uzaq qohum əmioğlu və ya xalaoğlu'],
            ['word' => 'twins', 'translation' => 'əkizlər'],
            ['word' => 'aunt', 'translation' => 'xala / bibi / əmi arvadı'],
            ['word' => 'uncle', 'translation' => 'dayı / əmi'],
            ['word' => 'nephew', 'translation' => 'bacıoğlu / qardaşoğlu'],
            ['word' => 'niece', 'translation' => 'bacıqızı / qardaşqızı'],
            ['word' => 'grandfather', 'translation' => 'baba'],
            ['word' => 'grandmother', 'translation' => 'nənə'],
            ['word' => 'grandparents', 'translation' => 'baba və nənə'],
            ['word' => 'great grandmother', 'translation' => 'ulu nənə'],
            ['word' => 'great grandfather', 'translation' => 'ulu baba'],
            ['word' => 'grandson', 'translation' => 'nəvə oğlan'],
            ['word' => 'granddaughter', 'translation' => 'nəvə qız'],
            ['word' => 'husband', 'translation' => 'ər'],
            ['word' => 'wife', 'translation' => 'arvad'],
            ['word' => 'child', 'translation' => 'uşaq'],
            ['word' => 'children', 'translation' => 'uşaqlar'],
            ['word' => 'grandchildren', 'translation' => 'nəvələr'],
            ['word' => 'baby', 'translation' => 'körpə'],
            ['word' => 'relative', 'translation' => 'qohum'],
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
