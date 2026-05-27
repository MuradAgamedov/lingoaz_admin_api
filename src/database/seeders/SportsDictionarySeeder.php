<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class SportsDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Sports')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Sports',
            ]);
        }

        $words = [

            ['word' => 'sport', 'translation' => 'idman'],
            ['word' => 'sportsman', 'translation' => 'idmançı'],
            ['word' => 'sports', 'translation' => 'idman növləri'],
            ['word' => 'sports club', 'translation' => 'idman klubu'],
            ['word' => 'sports school', 'translation' => 'idman məktəbi'],

            ['word' => 'do sports', 'translation' => 'idmanla məşğul olmaq'],
            ['word' => 'do wrestling', 'translation' => 'güləşlə məşğul olmaq'],
            ['word' => 'play sports', 'translation' => 'idman oyunları oynamaq'],
            ['word' => 'play basketball', 'translation' => 'basketbol oynamaq'],
            ['word' => 'play chess', 'translation' => 'şahmat oynamaq'],
            ['word' => 'go skateboarding', 'translation' => 'skeytbord sürmək'],
            ['word' => 'go in for', 'translation' => 'ilə məşğul olmaq'],
            ['word' => 'go in for swimming', 'translation' => 'üzgüçülüklə məşğul olmaq'],

            ['word' => 'football player', 'translation' => 'futbolçu'],
            ['word' => 'be a fan of', 'translation' => 'fanatı olmaq'],
            ['word' => 'join a sports club', 'translation' => 'idman klubuna yazılmaq'],

            ['word' => 'take part in competitions', 'translation' => 'yarışlarda iştirak etmək'],
            ['word' => 'take place in', 'translation' => 'keçirilmək'],
            ['word' => 'win', 'translation' => 'qalib gəlmək'],
            ['word' => 'lose', 'translation' => 'məğlub olmaq'],
            ['word' => 'win a prize', 'translation' => 'mükafat qazanmaq'],
            ['word' => 'win a cup', 'translation' => 'kubok qazanmaq'],

            ['word' => 'a winner', 'translation' => 'qalib'],
            ['word' => 'a loser', 'translation' => 'məğlub olan'],

            ['word' => 'match', 'translation' => 'matç'],
            ['word' => 'competition', 'translation' => 'yarış'],
            ['word' => 'train', 'translation' => 'məşq etmək'],
            ['word' => 'do training', 'translation' => 'məşqə getmək'],

            ['word' => 'at the skating rink', 'translation' => 'buz meydançasında'],
            ['word' => 'at the stadium', 'translation' => 'stadionda'],
            ['word' => 'at the football pitch', 'translation' => 'futbol meydançasında'],
            ['word' => 'at the sports ground', 'translation' => 'idman meydançasında'],
            ['word' => 'in the gym', 'translation' => 'idman zalında'],
            ['word' => 'in the swimming pool', 'translation' => 'hovuzda'],

            ['word' => 'basketball game', 'translation' => 'basketbol oyunu'],
            ['word' => 'hockey game', 'translation' => 'hokkey oyunu'],
            ['word' => 'tennis match', 'translation' => 'tennis matçı'],
            ['word' => 'boxing match', 'translation' => 'boks matçı'],
            ['word' => 'football match', 'translation' => 'futbol matçı'],
            ['word' => 'table-tennis match', 'translation' => 'stolüstü tennis matçı'],

            ['word' => 'swimming competition', 'translation' => 'üzgüçülük yarışı'],
            ['word' => 'racing competition', 'translation' => 'yarış müsabiqəsi'],
            ['word' => 'figure-skating competition', 'translation' => 'fiqurlu konkisürmə yarışı'],
            ['word' => 'speed-skating competition', 'translation' => 'sürətli konkisürmə yarışı'],

            ['word' => 'gymnastics', 'translation' => 'gimnastika'],
            ['word' => 'keep fit', 'translation' => 'formada qalmaq'],
            ['word' => 'healthy', 'translation' => 'sağlam'],
            ['word' => 'strong', 'translation' => 'güclü'],
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
