<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class SchoolDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'School')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'School',
            ]);
        }

        $words = [
            ['word' => 'school', 'translation' => 'məktəb'],
            ['word' => 'schoolboy', 'translation' => 'məktəbli oğlan'],
            ['word' => 'schoolgirl', 'translation' => 'məktəbli qız'],
            ['word' => 'student', 'translation' => 'şagird'],
            ['word' => 'do homework', 'translation' => 'ev tapşırığını etmək'],
            ['word' => 'mark in Maths', 'translation' => 'riyaziyyatdan qiymət'],
            ['word' => 'get good marks', 'translation' => 'yaxşı qiymətlər almaq'],
            ['word' => 'get bad marks', 'translation' => 'pis qiymətlər almaq'],
            ['word' => 'give marks', 'translation' => 'qiymət vermək'],
            ['word' => 'make new friends', 'translation' => 'yeni dostlar qazanmaq'],
            ['word' => 'have lessons a day', 'translation' => 'gündə dərsləri olmaq'],
            ['word' => 'learn', 'translation' => 'öyrənmək'],
            ['word' => 'learn new things', 'translation' => 'yeni şeylər öyrənmək'],
            ['word' => 'learn by heart', 'translation' => 'əzbərləmək'],
            ['word' => 'ask questions', 'translation' => 'sual vermək'],
            ['word' => 'answer questions', 'translation' => 'sualları cavablandırmaq'],
            ['word' => 'do sums', 'translation' => 'misallar həll etmək'],
            ['word' => 'solve problems', 'translation' => 'məsələlər həll etmək'],
            ['word' => 'get smarter', 'translation' => 'daha ağıllı olmaq'],
            ['word' => 'have fun during breaks', 'translation' => 'tənəffüsdə əylənmək'],
            ['word' => 'recite poems', 'translation' => 'şeirlər söyləmək'],
            ['word' => 'enjoy school parties', 'translation' => 'məktəb tədbirlərindən zövq almaq'],
            ['word' => 'study', 'translation' => 'oxumaq'],
            ['word' => 'work hard', 'translation' => 'çox çalışmaq'],
            ['word' => 'do my best', 'translation' => 'əlimdən gələni etmək'],
            ['word' => 'lesson', 'translation' => 'dərs'],
            ['word' => 'English lesson', 'translation' => 'ingilis dili dərsi'],
            ['word' => 'English teacher', 'translation' => 'ingilis dili müəllimi'],
            ['word' => 'strict', 'translation' => 'ciddi'],
            ['word' => 'kind', 'translation' => 'mehriban'],
            ['word' => 'subject', 'translation' => 'fənn'],
            ['word' => 'at the lesson', 'translation' => 'dərsdə'],
            ['word' => 'at school', 'translation' => 'məktəbdə'],
            ['word' => 'be in the form', 'translation' => 'sinifdə oxumaq'],
            ['word' => 'timetable', 'translation' => 'dərs cədvəli'],
            ['word' => 'lunch break', 'translation' => 'nahar fasiləsi'],
            ['word' => 'uniform', 'translation' => 'məktəb forması'],

            ['word' => 'Maths', 'translation' => 'riyaziyyat'],
            ['word' => 'Literature', 'translation' => 'ədəbiyyat'],
            ['word' => 'Russian', 'translation' => 'rus dili'],
            ['word' => 'Nature Study', 'translation' => 'təbiətşünaslıq'],
            ['word' => 'Science', 'translation' => 'elm'],
            ['word' => 'Geography', 'translation' => 'coğrafiya'],
            ['word' => 'History', 'translation' => 'tarix'],
            ['word' => 'PE', 'translation' => 'bədən tərbiyəsi'],
            ['word' => 'IT', 'translation' => 'informatika'],
            ['word' => 'Art', 'translation' => 'rəsm'],
            ['word' => 'foreign language', 'translation' => 'xarici dil'],
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
