<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class TravelDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Travel')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Travel',
            ]);
        }

        $words = [
            ['word' => 'travelling', 'translation' => 'səyahət'],
            ['word' => 'trip to', 'translation' => '... yerinə səyahət'],
            ['word' => 'all over the world', 'translation' => 'bütün dünya üzrə'],
            ['word' => 'go to', 'translation' => 'getmək'],
            ['word' => 'get to', 'translation' => 'çatmaq'],
            ['word' => 'travel to', 'translation' => 'səyahət etmək'],
            ['word' => 'visit different countries', 'translation' => 'fərqli ölkələri ziyarət etmək'],
            ['word' => 'museums and galleries', 'translation' => 'muzeylər və qalereyalar'],
            ['word' => 'go sightseeing', 'translation' => 'gəzməli yerləri gəzmək'],
            ['word' => 'see the sights', 'translation' => 'görməli yerləri görmək'],

            ['word' => 'travel abroad', 'translation' => 'xaricə səyahət etmək'],
            ['word' => 'travel around', 'translation' => 'ətrafda səyahət etmək'],
            ['word' => 'travel by car', 'translation' => 'maşınla səyahət etmək'],
            ['word' => 'travel by coach', 'translation' => 'avtobusla səyahət etmək'],
            ['word' => 'travel by train', 'translation' => 'qatarla səyahət etmək'],
            ['word' => 'travel by air', 'translation' => 'təyyarə ilə səyahət etmək'],
            ['word' => 'travel by plane', 'translation' => 'təyyarə ilə getmək'],
            ['word' => 'travel by sea', 'translation' => 'dəniz yolu ilə səyahət etmək'],
            ['word' => 'travel by ship', 'translation' => 'gəmi ilə səyahət etmək'],

            ['word' => 'leave', 'translation' => 'ayrılmaq'],
            ['word' => 'spend a week in', 'translation' => 'bir həftə keçirmək'],
            ['word' => 'on the way to', 'translation' => 'yolunda'],
            ['word' => 'on the way home', 'translation' => 'evə gedən yolda'],
            ['word' => 'during the trip', 'translation' => 'səyahət zamanı'],
            ['word' => 'stay at a hotel', 'translation' => 'oteldə qalmaq'],
            ['word' => 'walk around the city', 'translation' => 'şəhərdə gəzmək'],
            ['word' => 'try local food', 'translation' => 'yerli yeməkləri dadmaq'],
            ['word' => 'buy souvenirs', 'translation' => 'suvenirlər almaq'],

            ['word' => 'exciting', 'translation' => 'maraqlı'],
            ['word' => 'unusual', 'translation' => 'qeyri-adi'],
            ['word' => 'make new friends', 'translation' => 'yeni dostlar qazanmaq'],
            ['word' => 'meet new people', 'translation' => 'yeni insanlarla tanış olmaq'],
            ['word' => 'improve my English', 'translation' => 'ingilis dilimi inkişaf etdirmək'],
            ['word' => 'lie in the sun on the beach', 'translation' => 'çimərlikdə günəşlənmək'],
            ['word' => 'have a wonderful time', 'translation' => 'əla vaxt keçirmək'],
            ['word' => 'enjoy the trip', 'translation' => 'səyahətdən zövq almaq'],
            ['word' => 'come back home', 'translation' => 'evə qayıtmaq'],

            ['word' => 'means of transport', 'translation' => 'nəqliyyat vasitələri'],
            ['word' => 'historical sights', 'translation' => 'tarixi yerlər'],
            ['word' => 'world-famous sights', 'translation' => 'dünyaca məşhur görməli yerlər'],
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
