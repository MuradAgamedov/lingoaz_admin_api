<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class WeatherAndSeasonsDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Weather and Seasons')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Weather and Seasons',
            ]);
        }

        $words = [
            ['word' => 'weather', 'translation' => 'hava'],
            ['word' => 'fine', 'translation' => 'gözəl'],
            ['word' => 'terrible', 'translation' => 'dəhşətli'],
            ['word' => 'cold', 'translation' => 'soyuq'],
            ['word' => 'hot', 'translation' => 'isti'],
            ['word' => 'warm', 'translation' => 'ilıq'],
            ['word' => 'the sky', 'translation' => 'göy'],
            ['word' => 'the sun', 'translation' => 'günəş'],
            ['word' => 'rain', 'translation' => 'yağış'],
            ['word' => 'wind', 'translation' => 'külək'],
            ['word' => 'cloud', 'translation' => 'bulud'],
            ['word' => 'snow', 'translation' => 'qar'],
            ['word' => 'sunny', 'translation' => 'günəşli'],
            ['word' => 'rainy', 'translation' => 'yağışlı'],
            ['word' => 'windy', 'translation' => 'küləkli'],
            ['word' => 'cloudy', 'translation' => 'buludlu'],
            ['word' => 'bright', 'translation' => 'parlaq'],
            ['word' => 'snowy', 'translation' => 'qarlı'],
            ['word' => 'to rain', 'translation' => 'yağış yağmaq'],
            ['word' => 'to snow', 'translation' => 'qar yağmaq'],
            ['word' => 'to blow', 'translation' => 'əsmək'],
            ['word' => 'to shine', 'translation' => 'işıq saçmaq'],
            ['word' => 'to get warmer / colder', 'translation' => 'isinmək / soyumaq'],
            ['word' => 'to change', 'translation' => 'dəyişmək'],
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
