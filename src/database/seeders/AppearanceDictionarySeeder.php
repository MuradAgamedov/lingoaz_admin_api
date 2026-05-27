<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class AppearanceDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Appearance')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Appearance',
            ]);
        }

        $words = [
            ['word' => 'appearance', 'translation' => 'xarici görünüş'],
            ['word' => 'nice', 'translation' => 'xoş görkəmli'],
            ['word' => 'pretty', 'translation' => 'qəşəng'],
            ['word' => 'beautiful', 'translation' => 'gözəl'],
            ['word' => 'handsome', 'translation' => 'yaraşıqlı'],
            ['word' => 'good-looking', 'translation' => 'cazibədar'],
            ['word' => 'plain', 'translation' => 'sadə görünüşlü'],
            ['word' => 'ugly', 'translation' => 'çirkin'],

            ['word' => 'height', 'translation' => 'boy'],
            ['word' => 'tall', 'translation' => 'hündür'],
            ['word' => 'short', 'translation' => 'qısa boylu'],
            ['word' => 'middle-sized', 'translation' => 'orta boylu'],

            ['word' => 'build', 'translation' => 'bədən quruluşu'],
            ['word' => 'thin', 'translation' => 'arıq'],
            ['word' => 'fat', 'translation' => 'kök'],
            ['word' => 'slim', 'translation' => 'incə bədənli'],
            ['word' => 'athletic', 'translation' => 'atletik'],

            ['word' => 'hair colour', 'translation' => 'saç rəngi'],
            ['word' => 'fair', 'translation' => 'açıq rəngli'],
            ['word' => 'dark', 'translation' => 'tünd'],
            ['word' => 'black', 'translation' => 'qara'],
            ['word' => 'brown', 'translation' => 'qəhvəyi'],
            ['word' => 'red', 'translation' => 'qırmızı / kürən'],
            ['word' => 'blond', 'translation' => 'sarışın'],

            ['word' => 'hair', 'translation' => 'saç'],
            ['word' => 'long', 'translation' => 'uzun'],
            ['word' => 'straight', 'translation' => 'düz'],
            ['word' => 'wavy', 'translation' => 'dalğalı'],
            ['word' => 'curly', 'translation' => 'buruq'],
            ['word' => 'thick', 'translation' => 'qalın / sıx'],
            ['word' => 'thin hair', 'translation' => 'seyrək saç'],

            ['word' => 'eyes', 'translation' => 'gözlər'],
            ['word' => 'big', 'translation' => 'böyük'],
            ['word' => 'little', 'translation' => 'kiçik'],
            ['word' => 'green', 'translation' => 'yaşıl'],
            ['word' => 'blue', 'translation' => 'mavi'],
            ['word' => 'hazel', 'translation' => 'fındıq rəngli'],

            ['word' => 'face', 'translation' => 'üz'],
            ['word' => 'round', 'translation' => 'yumru'],
            ['word' => 'oval', 'translation' => 'oval'],

            ['word' => 'nose', 'translation' => 'burun'],
            ['word' => 'turned up', 'translation' => 'yuxarı qalxmış burun'],

            ['word' => 'mouth', 'translation' => 'ağız'],
            ['word' => 'lips', 'translation' => 'dodaqlar'],
            ['word' => 'teeth', 'translation' => 'dişlər'],
            ['word' => 'ears', 'translation' => 'qulaqlar'],
            ['word' => 'forehead', 'translation' => 'alın'],
            ['word' => 'neck', 'translation' => 'boyun'],
            ['word' => 'body', 'translation' => 'bədən'],
            ['word' => 'arms', 'translation' => 'qollar'],
            ['word' => 'hands', 'translation' => 'əllər'],
            ['word' => 'legs', 'translation' => 'ayaqlar'],
            ['word' => 'knees', 'translation' => 'dizlər'],
            ['word' => 'feet', 'translation' => 'ayaq pəncələri'],
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
