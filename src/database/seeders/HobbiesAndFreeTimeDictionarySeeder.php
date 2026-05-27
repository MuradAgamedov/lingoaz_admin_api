<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class HobbiesAndFreeTimeDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Hobbies and Free Time')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Hobbies and Free Time',
            ]);
        }

        $words = [
            ['word' => 'collect', 'translation' => 'toplamaq'],
            ['word' => 'collecting', 'translation' => 'kolleksiya toplamaq'],
            ['word' => 'collection', 'translation' => 'kolleksiya'],
            ['word' => 'stamp collection', 'translation' => 'marka kolleksiyası'],
            ['word' => 'consist of', 'translation' => 'ibarət olmaq'],
            ['word' => 'be fond of', 'translation' => 'xoşlamaq'],
            ['word' => 'be proud of', 'translation' => 'fəxr etmək'],
            ['word' => 'be interested in', 'translation' => 'maraqlanmaq'],
            ['word' => 'be good at', 'translation' => 'yaxşı bacarmaq'],
            ['word' => 'be keen on', 'translation' => 'çox maraqlanmaq'],
            ['word' => 'be crazy about', 'translation' => 'vurğun olmaq'],
            ['word' => 'have fun', 'translation' => 'əylənmək'],
            ['word' => 'have a good time', 'translation' => 'xoş vaxt keçirmək'],
            ['word' => 'be popular with', 'translation' => 'arasında məşhur olmaq'],
            ['word' => 'exciting', 'translation' => 'maraqlı'],
            ['word' => 'expensive', 'translation' => 'bahalı'],
            ['word' => 'do nothing', 'translation' => 'heç nə etməmək'],
            ['word' => 'go out', 'translation' => 'çölə çıxmaq'],
            ['word' => 'stay at home', 'translation' => 'evdə qalmaq'],
            ['word' => 'surf the Internet', 'translation' => 'internetdə gəzmək'],
            ['word' => 'rest', 'translation' => 'istirahət etmək'],
            ['word' => 'have a rest', 'translation' => 'dincəlmək'],
            ['word' => 'get bored', 'translation' => 'darıxmaq'],
            ['word' => 'share pictures', 'translation' => 'şəkilləri paylaşmaq'],
            ['word' => 'share photos', 'translation' => 'fotoları paylaşmaq'],
            ['word' => 'play table games', 'translation' => 'masaüstü oyunlar oynamaq'],
            ['word' => 'arrange a party', 'translation' => 'məclis təşkil etmək'],
            ['word' => 'take up', 'translation' => 'başlamaq'],
            ['word' => 'give up', 'translation' => 'imtina etmək'],
            ['word' => 'reading books', 'translation' => 'kitab oxumaq'],
            ['word' => 'photography', 'translation' => 'fotoqrafiya'],
            ['word' => 'dancing', 'translation' => 'rəqs etmək'],
            ['word' => 'singing', 'translation' => 'mahnı oxumaq'],
            ['word' => 'playing the guitar', 'translation' => 'gitara çalmaq'],
            ['word' => 'drawing', 'translation' => 'rəsm çəkmək'],
            ['word' => 'painting', 'translation' => 'boyama / rəssamlıq'],
            ['word' => 'playing computer games', 'translation' => 'kompüter oyunları oynamaq'],
            ['word' => 'stamps', 'translation' => 'markalar'],
            ['word' => 'badges', 'translation' => 'nişanlar'],
            ['word' => 'coins', 'translation' => 'sikkələr'],
            ['word' => 'cards', 'translation' => 'kartlar'],
            ['word' => 'pictures', 'translation' => 'şəkillər'],
            ['word' => 'statuettes', 'translation' => 'heykəlciklər'],
            ['word' => 'dolls', 'translation' => 'kuklalar'],
            ['word' => 'toys', 'translation' => 'oyuncaqlar'],
            ['word' => 'toy soldiers', 'translation' => 'oyuncaq əsgərlər'],
            ['word' => 'toy cars', 'translation' => 'oyuncaq maşınlar'],
            ['word' => 'velvet toys', 'translation' => 'yumşaq oyuncaqlar'],
            ['word' => 'discs', 'translation' => 'disklər'],
            ['word' => 'records', 'translation' => 'plastinkalar'],
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
