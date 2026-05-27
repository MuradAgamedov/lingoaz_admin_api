<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class CharacterDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Character')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Character',
            ]);
        }

        $words = [
            ['word' => 'typical', 'translation' => 'tipik'],
            ['word' => 'close', 'translation' => 'yaxın'],
            ['word' => 'loving', 'translation' => 'sevən'],
            ['word' => 'friendly', 'translation' => 'mehriban'],
            ['word' => 'caring', 'translation' => 'qayğıkeş'],
            ['word' => 'independent', 'translation' => 'müstəqil'],
            ['word' => 'smart', 'translation' => 'zirək'],
            ['word' => 'clever', 'translation' => 'ağıllı'],
            ['word' => 'serious', 'translation' => 'ciddi'],
            ['word' => 'kind', 'translation' => 'xeyirxah'],
            ['word' => 'lazy', 'translation' => 'tənbəl'],
            ['word' => 'busy', 'translation' => 'məşğul'],
            ['word' => 'bossy', 'translation' => 'əmr verməyi sevən'],
            ['word' => 'naughty', 'translation' => 'dəcəl'],
            ['word' => 'noisy', 'translation' => 'səs-küylü'],
            ['word' => 'creative', 'translation' => 'yaradıcı'],
            ['word' => 'strong', 'translation' => 'güclü'],
            ['word' => 'brave', 'translation' => 'cəsur'],
            ['word' => 'active', 'translation' => 'aktiv'],
            ['word' => 'quiet', 'translation' => 'sakit'],
            ['word' => 'angry', 'translation' => 'əsəbi'],
            ['word' => 'talkative', 'translation' => 'danışqan'],
            ['word' => 'helpful', 'translation' => 'köməksevər'],
            ['word' => 'tidy', 'translation' => 'səliqəli'],
            ['word' => 'polite', 'translation' => 'nəzakətli'],
            ['word' => 'silly', 'translation' => 'axmaq'],
            ['word' => 'honest', 'translation' => 'dürüst'],
            ['word' => 'curious', 'translation' => 'maraqlı'],
            ['word' => 'shy', 'translation' => 'utancaq'],
            ['word' => 'sociable', 'translation' => 'ünsiyyətcil'],
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
