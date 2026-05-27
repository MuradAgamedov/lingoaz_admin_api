<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class NatureDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Nature')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Nature',
            ]);
        }

        $words = [

            // Nouns
            ['word' => 'the sun', 'translation' => 'günəş'],
            ['word' => 'sunset', 'translation' => 'gün batımı'],
            ['word' => 'sunrise', 'translation' => 'gün doğumu'],
            ['word' => 'the stars', 'translation' => 'ulduzlar'],
            ['word' => 'the moon', 'translation' => 'ay'],
            ['word' => 'the sky', 'translation' => 'göy'],
            ['word' => 'cloud', 'translation' => 'bulud'],
            ['word' => 'ground', 'translation' => 'torpaq'],
            ['word' => 'road', 'translation' => 'yol'],
            ['word' => 'river', 'translation' => 'çay'],
            ['word' => 'bank', 'translation' => 'sahil'],
            ['word' => 'lake', 'translation' => 'göl'],
            ['word' => 'sea', 'translation' => 'dəniz'],
            ['word' => 'beach', 'translation' => 'çimərlik'],
            ['word' => 'seaside', 'translation' => 'dəniz kənarı'],
            ['word' => 'ocean', 'translation' => 'okean'],
            ['word' => 'water', 'translation' => 'su'],
            ['word' => 'air', 'translation' => 'hava'],
            ['word' => 'wind', 'translation' => 'külək'],
            ['word' => 'hill', 'translation' => 'təpə'],
            ['word' => 'mountain', 'translation' => 'dağ'],
            ['word' => 'stone', 'translation' => 'daş'],
            ['word' => 'field', 'translation' => 'sahə'],
            ['word' => 'grass', 'translation' => 'ot'],
            ['word' => 'flower', 'translation' => 'gül'],
            ['word' => 'forest', 'translation' => 'meşə'],
            ['word' => 'garden', 'translation' => 'bağ'],
            ['word' => 'tree', 'translation' => 'ağac'],
            ['word' => 'plant', 'translation' => 'bitki'],
            ['word' => 'leaf', 'translation' => 'yarpaq'],
            ['word' => 'leaves', 'translation' => 'yarpaqlar'],

            // Adjectives
            ['word' => 'bright', 'translation' => 'parlaq'],
            ['word' => 'cloudless', 'translation' => 'buludsuz'],
            ['word' => 'cloudy', 'translation' => 'buludlu'],
            ['word' => 'strong', 'translation' => 'güclü'],
            ['word' => 'deep', 'translation' => 'dərin'],
            ['word' => 'high', 'translation' => 'hündür'],
            ['word' => 'thick', 'translation' => 'sıx'],
            ['word' => 'big', 'translation' => 'böyük'],
            ['word' => 'small', 'translation' => 'kiçik'],
            ['word' => 'quiet', 'translation' => 'sakit'],
            ['word' => 'fresh', 'translation' => 'təmiz'],
            ['word' => 'different', 'translation' => 'fərqli'],
            ['word' => 'beautiful', 'translation' => 'gözəl'],
            ['word' => 'wonderful', 'translation' => 'möhtəşəm'],

            // Verbs
            ['word' => 'shine', 'translation' => 'işıq saçmaq'],
            ['word' => 'rise', 'translation' => 'qalxmaq'],
            ['word' => 'set', 'translation' => 'batmaq'],
            ['word' => 'be covered with', 'translation' => 'ilə örtülmək'],
            ['word' => 'be full of', 'translation' => 'ilə dolu olmaq'],
            ['word' => 'be beautiful with', 'translation' => 'ilə gözəl görünmək'],
            ['word' => 'grow', 'translation' => 'böyümək'],
            ['word' => 'blow', 'translation' => 'əsmək'],
            ['word' => 'smell', 'translation' => 'qoxmaq'],
            ['word' => 'fall down', 'translation' => 'düşmək'],

            // Expressions
            ['word' => 'by day', 'translation' => 'gündüz'],
            ['word' => 'at night', 'translation' => 'gecə'],
            ['word' => 'in the sky', 'translation' => 'göydə'],
            ['word' => 'at sunset', 'translation' => 'gün batımında'],
            ['word' => 'at sunrise', 'translation' => 'gün doğumunda'],
            ['word' => 'on the ground', 'translation' => 'yerdə'],
            ['word' => 'in the field', 'translation' => 'sahədə'],
            ['word' => 'at the seaside', 'translation' => 'dəniz kənarında'],
            ['word' => 'in the forest', 'translation' => 'meşədə'],
            ['word' => 'in the tree', 'translation' => 'ağacda'],
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
