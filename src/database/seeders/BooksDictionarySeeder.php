<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class BooksDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Books')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Books',
            ]);
        }

        $words = [
            ['word' => 'a book', 'translation' => 'kitab'],
            ['word' => 'a travel book', 'translation' => 'səyahət kitabı'],
            ['word' => 'a fantasy book', 'translation' => 'fantastik kitab'],
            ['word' => 'a story', 'translation' => 'hekayə'],
            ['word' => 'a short story', 'translation' => 'qısa hekayə'],
            ['word' => 'a detective story', 'translation' => 'detektiv hekayə'],
            ['word' => 'a love story', 'translation' => 'sevgi hekayəsi'],
            ['word' => 'a horror story', 'translation' => 'qorxu hekayəsi'],
            ['word' => 'a fairy tale', 'translation' => 'nağıl'],
            ['word' => 'a legend', 'translation' => 'əfsanə'],

            ['word' => 'I like reading', 'translation' => 'mən oxumağı sevirəm'],
            ['word' => 'I enjoy reading', 'translation' => 'mən oxumaqdan zövq alıram'],

            ['word' => 'exciting', 'translation' => 'maraqlı'],
            ['word' => 'entertaining', 'translation' => 'əyləncəli'],
            ['word' => 'easy to read', 'translation' => 'asan oxunan'],
            ['word' => 'boring', 'translation' => 'darıxdırıcı'],

            ['word' => 'writer', 'translation' => 'yazıçı'],
            ['word' => 'be famous for', 'translation' => 'ilə məşhur olmaq'],
            ['word' => 'well-known', 'translation' => 'tanınmış'],
            ['word' => 'great', 'translation' => 'böyük'],
            ['word' => 'world-famous', 'translation' => 'dünyaca məşhur'],
            ['word' => 'classical', 'translation' => 'klassik'],

            ['word' => 'title', 'translation' => 'başlıq'],
            ['word' => 'name', 'translation' => 'ad'],
            ['word' => 'plot', 'translation' => 'süjet'],
            ['word' => 'main character', 'translation' => 'baş qəhrəman'],
            ['word' => 'brave', 'translation' => 'cəsur'],
            ['word' => 'inventive', 'translation' => 'ixtiraçı'],
            ['word' => 'clever', 'translation' => 'ağıllı'],
            ['word' => 'independent', 'translation' => 'müstəqil'],
            ['word' => 'useful', 'translation' => 'faydalı'],

            ['word' => 'magazine', 'translation' => 'jurnal'],
            ['word' => 'newspaper', 'translation' => 'qəzet'],
            ['word' => 'library', 'translation' => 'kitabxana'],
            ['word' => 'borrow books from the library', 'translation' => 'kitabxanadan kitab götürmək'],
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
