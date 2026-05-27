<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class CityDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'City')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'City',
            ]);
        }

        $words = [

            // Nouns
            ['word' => 'the capital', 'translation' => 'paytaxt'],
            ['word' => 'city', 'translation' => 'şəhər'],
            ['word' => 'town', 'translation' => 'kiçik şəhər'],
            ['word' => 'lawn', 'translation' => 'yaşıl çəmənlik'],
            ['word' => 'square', 'translation' => 'meydan'],
            ['word' => 'the centre', 'translation' => 'mərkəz'],
            ['word' => 'street', 'translation' => 'küçə'],
            ['word' => 'place', 'translation' => 'yer'],
            ['word' => 'palace', 'translation' => 'saray'],
            ['word' => 'castle', 'translation' => 'qala'],
            ['word' => 'bridge', 'translation' => 'körpü'],
            ['word' => 'park', 'translation' => 'park'],
            ['word' => 'the cinema', 'translation' => 'kinoteatr'],
            ['word' => 'the theatre', 'translation' => 'teatr'],
            ['word' => 'the museum', 'translation' => 'muzey'],
            ['word' => 'the library', 'translation' => 'kitabxana'],
            ['word' => 'the stadium', 'translation' => 'stadion'],
            ['word' => 'the zoo', 'translation' => 'zoopark'],
            ['word' => 'the church', 'translation' => 'kilsə'],
            ['word' => 'corner shop', 'translation' => 'kiçik mağaza'],
            ['word' => 'market', 'translation' => 'bazar'],
            ['word' => 'supermarket', 'translation' => 'supermarket'],
            ['word' => 'a view of', 'translation' => 'mənzərə'],

            // Adjectives
            ['word' => 'new', 'translation' => 'yeni'],
            ['word' => 'old', 'translation' => 'köhnə'],
            ['word' => 'small', 'translation' => 'kiçik'],
            ['word' => 'big', 'translation' => 'böyük'],
            ['word' => 'high', 'translation' => 'hündür'],
            ['word' => 'tall', 'translation' => 'uca'],
            ['word' => 'famous', 'translation' => 'məşhur'],
            ['word' => 'beautiful', 'translation' => 'gözəl'],
            ['word' => 'main', 'translation' => 'əsas'],
            ['word' => 'narrow', 'translation' => 'dar'],
            ['word' => 'wide', 'translation' => 'geniş'],
            ['word' => 'straight', 'translation' => 'düz'],

            // Expressions
            ['word' => 'be proud of', 'translation' => 'ilə fəxr etmək'],
            ['word' => 'be rich in', 'translation' => 'ilə zəngin olmaq'],
            ['word' => 'be famous for', 'translation' => 'ilə məşhur olmaq'],
            ['word' => 'be full of', 'translation' => 'ilə dolu olmaq'],
            ['word' => 'be not far', 'translation' => 'uzaqda olmamaq'],

            // Additional words
            ['word' => 'fresh', 'translation' => 'təmiz'],
            ['word' => 'mainly', 'translation' => 'əsasən'],
            ['word' => 'fortress', 'translation' => 'qala'],
            ['word' => 'cathedral', 'translation' => 'kafedral'],
            ['word' => 'ancient', 'translation' => 'qədim'],
            ['word' => 'magnificent', 'translation' => 'möhtəşəm'],
            ['word' => 'historical', 'translation' => 'tarixi'],
            ['word' => 'impressive', 'translation' => 'təsiredici'],
            ['word' => 'be located', 'translation' => 'yerləşmək'],
            ['word' => 'tourist', 'translation' => 'turist'],
            ['word' => 'souvenir', 'translation' => 'suvenir'],
            ['word' => 'do sightseeing', 'translation' => 'gəzməli yerləri gəzmək'],
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
