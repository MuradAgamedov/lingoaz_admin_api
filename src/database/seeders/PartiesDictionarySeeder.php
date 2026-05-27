<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class PartiesDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Parties')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Parties',
            ]);
        }

        $words = [

            ['word' => 'present', 'translation' => 'hədiyyə'],
            ['word' => 'give presents', 'translation' => 'hədiyyə vermək'],
            ['word' => 'get presents', 'translation' => 'hədiyyə almaq'],
            ['word' => 'buy presents', 'translation' => 'hədiyyə almaq'],

            ['word' => 'be smart', 'translation' => 'səliqəli görünmək'],
            ['word' => 'put on smart clothes', 'translation' => 'gözəl paltar geyinmək'],

            ['word' => 'decorate the room with', 'translation' => 'otağı bəzəmək'],
            ['word' => 'make special dishes', 'translation' => 'xüsusi yeməklər hazırlamaq'],

            ['word' => 'be responsible for music', 'translation' => 'musiqiyə cavabdeh olmaq'],
            ['word' => 'bring the guitar', 'translation' => 'gitaranı gətirmək'],
            ['word' => 'play the guitar', 'translation' => 'gitara çalmaq'],
            ['word' => 'play music', 'translation' => 'musiqi səsləndirmək'],

            ['word' => 'invite friends and relatives', 'translation' => 'dostları və qohumları dəvət etmək'],
            ['word' => 'write invitations', 'translation' => 'dəvətnamə yazmaq'],

            ['word' => 'sing', 'translation' => 'mahnı oxumaq'],
            ['word' => 'dance', 'translation' => 'rəqs etmək'],
            ['word' => 'wish', 'translation' => 'arzulamaq'],
            ['word' => 'talk a lot', 'translation' => 'çox danışmaq'],
            ['word' => 'have fun', 'translation' => 'əylənmək'],

            // Types of parties
            ['word' => 'a birthday party', 'translation' => 'ad günü məclisi'],
            ['word' => 'a picnic', 'translation' => 'piknik'],
            ['word' => 'a school party', 'translation' => 'məktəb məclisi'],
            ['word' => 'a disco', 'translation' => 'diskoteka'],
            ['word' => 'New Year’s party', 'translation' => 'Yeni il məclisi'],
            ['word' => 'a house-warming party', 'translation' => 'evə köçmə məclisi'],
            ['word' => 'a wedding', 'translation' => 'toy'],

            // Wishes
            ['word' => 'Happy New Year!', 'translation' => 'Yeni iliniz mübarək!'],
            ['word' => 'Happy Birthday!', 'translation' => 'Ad günün mübarək!'],
            ['word' => 'Many happy returns of the day!', 'translation' => 'Uzun ömür arzulayıram!'],
            ['word' => 'Merry Christmas!', 'translation' => 'Milad bayramınız mübarək!'],
            ['word' => 'Congratulations!', 'translation' => 'Təbrik edirik!'],
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
