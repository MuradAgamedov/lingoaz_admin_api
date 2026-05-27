<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class ProfessionsDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Professions')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Professions',
            ]);
        }

        $words = [

            // General phrases
            ['word' => 'my dream', 'translation' => 'mənim arzum'],
            ['word' => 'come true', 'translation' => 'gerçəkləşmək'],
            ['word' => 'take exams', 'translation' => 'imtahan vermək'],
            ['word' => 'leave school', 'translation' => 'məktəbi bitirmək'],
            ['word' => 'enter an institute', 'translation' => 'instituta daxil olmaq'],
            ['word' => 'enter a college', 'translation' => 'kollecə daxil olmaq'],
            ['word' => 'get education', 'translation' => 'təhsil almaq'],
            ['word' => 'find a job', 'translation' => 'iş tapmaq'],
            ['word' => 'be independent', 'translation' => 'müstəqil olmaq'],
            ['word' => 'be interested in', 'translation' => 'maraqlanmaq'],
            ['word' => 'study hard', 'translation' => 'çox çalışmaq'],
            ['word' => 'decide', 'translation' => 'qərar vermək'],
            ['word' => 'make up one’s mind', 'translation' => 'qərarını vermək'],
            ['word' => 'change one’s mind', 'translation' => 'fikrini dəyişmək'],
            ['word' => 'choose', 'translation' => 'seçmək'],
            ['word' => 'make a choice', 'translation' => 'seçim etmək'],
            ['word' => 'the right choice', 'translation' => 'düzgün seçim'],
            ['word' => 'the wrong choice', 'translation' => 'səhv seçim'],
            ['word' => 'make a career', 'translation' => 'karyera qurmaq'],
            ['word' => 'be successful', 'translation' => 'uğurlu olmaq'],
            ['word' => 'by profession', 'translation' => 'peşəsinə görə'],

            // Occupations
            ['word' => 'a pupil', 'translation' => 'ibtidai sinif şagirdi'],
            ['word' => 'a student', 'translation' => 'şagird / tələbə'],
            ['word' => 'a housewife', 'translation' => 'evdar qadın'],

            // Creative professions
            ['word' => 'a designer', 'translation' => 'dizayner'],
            ['word' => 'a photographer', 'translation' => 'fotoqraf'],
            ['word' => 'an architect', 'translation' => 'memar'],
            ['word' => 'a painter', 'translation' => 'rəssam'],
            ['word' => 'an artist', 'translation' => 'incəsənətçi'],
            ['word' => 'an actor', 'translation' => 'aktyor'],
            ['word' => 'an actress', 'translation' => 'aktrisa'],
            ['word' => 'a film actor', 'translation' => 'kino aktyoru'],
            ['word' => 'a singer', 'translation' => 'müğənni'],
            ['word' => 'a pianist', 'translation' => 'pianoçu'],
            ['word' => 'a musician', 'translation' => 'musiqiçi'],
            ['word' => 'a ballet dancer', 'translation' => 'balet rəqqası'],

            // Work with machines
            ['word' => 'a programmer', 'translation' => 'proqramçı'],
            ['word' => 'a bus driver', 'translation' => 'avtobus sürücüsü'],
            ['word' => 'a taxi driver', 'translation' => 'taksi sürücüsü'],
            ['word' => 'a worker', 'translation' => 'fəhlə'],
            ['word' => 'a builder', 'translation' => 'tikinti işçisi'],

            // Work with people
            ['word' => 'a director', 'translation' => 'direktor'],
            ['word' => 'a film director', 'translation' => 'film rejissoru'],
            ['word' => 'a journalist', 'translation' => 'jurnalist'],
            ['word' => 'a teacher', 'translation' => 'müəllim'],
            ['word' => 'a nurse', 'translation' => 'tibb bacısı'],
            ['word' => 'a doctor', 'translation' => 'həkim'],
            ['word' => 'a dentist', 'translation' => 'diş həkimi'],
            ['word' => 'a vet', 'translation' => 'baytar'],
            ['word' => 'a secretary', 'translation' => 'katibə'],
            ['word' => 'a manager', 'translation' => 'menecer'],
            ['word' => 'a lawyer', 'translation' => 'hüquqşünas'],

            // Extreme jobs
            ['word' => 'a policeman', 'translation' => 'polis'],
            ['word' => 'a police officer', 'translation' => 'polis əməkdaşı'],
            ['word' => 'a fireman', 'translation' => 'yanğınsöndürən'],
            ['word' => 'a security guard', 'translation' => 'mühafizəçi'],
            ['word' => 'a bodyguard', 'translation' => 'cangüdən'],
            ['word' => 'a life guard', 'translation' => 'xilasedici'],

            // Intellectual professions
            ['word' => 'a banker', 'translation' => 'bankir'],
            ['word' => 'an engineer', 'translation' => 'mühəndis'],
            ['word' => 'a scientist', 'translation' => 'alim'],
            ['word' => 'a translator', 'translation' => 'tərcüməçi'],
            ['word' => 'an interpreter', 'translation' => 'şifahi tərcüməçi'],

            // Others
            ['word' => 'a model', 'translation' => 'model'],
            ['word' => 'a postman', 'translation' => 'poçtalyon'],
            ['word' => 'a librarian', 'translation' => 'kitabxanaçı'],
            ['word' => 'a sportsman', 'translation' => 'idmançı'],
            ['word' => 'a professional footballer', 'translation' => 'peşəkar futbolçu'],
            ['word' => 'a cook', 'translation' => 'aşpaz'],
            ['word' => 'a chef', 'translation' => 'şef aşpaz'],
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
