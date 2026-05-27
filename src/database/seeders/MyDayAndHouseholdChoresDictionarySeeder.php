<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class MyDayAndHouseholdChoresDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'My Day and Household Chores')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'My Day and Household Chores',
            ]);
        }

        $words = [
            ['word' => 'get up early / late', 'translation' => 'tez / gec oyanmaq'],
            ['word' => 'go to bed early / late', 'translation' => 'tez / gec yatmaq'],
            ['word' => 'make the bed', 'translation' => 'yatağı yığışdırmaq'],
            ['word' => 'take a shower', 'translation' => 'duş qəbul etmək'],
            ['word' => 'take a bath', 'translation' => 'vanna qəbul etmək'],
            ['word' => 'dress', 'translation' => 'geyinmək'],
            ['word' => 'get dressed', 'translation' => 'geyinmək'],
            ['word' => 'wash my face', 'translation' => 'üzümü yumaq'],
            ['word' => 'clean my teeth', 'translation' => 'dişlərimi fırçalamaq'],
            ['word' => 'shave myself', 'translation' => 'üz qırxmaq'],
            ['word' => 'have breakfast', 'translation' => 'səhər yeməyi yemək'],
            ['word' => 'have lunch', 'translation' => 'nahar etmək'],
            ['word' => 'have dinner', 'translation' => 'şam yeməyi yemək'],
            ['word' => 'have for breakfast', 'translation' => 'səhər yeməyində yemək'],
            ['word' => 'go to work', 'translation' => 'işə getmək'],
            ['word' => 'leave home for work', 'translation' => 'evdən işə çıxmaq'],
            ['word' => 'come home from work', 'translation' => 'işdən evə gəlmək'],
            ['word' => 'have English lessons', 'translation' => 'ingilis dili dərsləri keçmək'],
            ['word' => 'read books', 'translation' => 'kitab oxumaq'],
            ['word' => 'watch TV', 'translation' => 'televizora baxmaq'],
            ['word' => 'surf the Net', 'translation' => 'internetdə gəzmək'],
            ['word' => 'do the cooking', 'translation' => 'yemək bişirmək'],
            ['word' => 'cook breakfast', 'translation' => 'səhər yeməyi hazırlamaq'],
            ['word' => 'cook lunch', 'translation' => 'nahar hazırlamaq'],
            ['word' => 'cook dinner', 'translation' => 'şam yeməyi hazırlamaq'],
            ['word' => 'do the washing', 'translation' => 'paltar yumaq'],
            ['word' => 'do the ironing', 'translation' => 'ütü etmək'],
            ['word' => 'wash up', 'translation' => 'qabları yumaq'],
            ['word' => 'do housework', 'translation' => 'ev işləri görmək'],
            ['word' => 'clean the flat', 'translation' => 'evi təmizləmək'],
            ['word' => 'do homework', 'translation' => 'ev tapşırığını etmək'],
            ['word' => 'feed the dog', 'translation' => 'iti yemləmək'],
            ['word' => 'go for a walk', 'translation' => 'gəzintiyə çıxmaq'],
            ['word' => 'take the dog out', 'translation' => 'iti gəzdirməyə çıxarmaq'],
            ['word' => 'go out', 'translation' => 'evdən çıxmaq / harasa getmək'],
            ['word' => 'go shopping', 'translation' => 'alış-verişə getmək'],
            ['word' => 'have a rest', 'translation' => 'dincəlmək'],
            ['word' => 'go to see smb', 'translation' => 'kimisə ziyarət etmək'],
            ['word' => 'by the end of the week', 'translation' => 'həftənin sonuna qədər'],
            ['word' => 'by next Monday', 'translation' => 'gələn bazar ertəsinə qədər'],
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
