<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class CountriesAndNationalitiesDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Countries and Nationalities')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Countries and Nationalities',
            ]);
        }

        $words = [

            // Basic words
            ['word' => 'country', 'translation' => 'ölkə'],
            ['word' => 'nationality', 'translation' => 'milliyyət'],
            ['word' => 'language', 'translation' => 'dil'],

            // Countries, nationalities, languages
            ['word' => 'Russia', 'translation' => 'Rusiya'],
            ['word' => 'Russians', 'translation' => 'ruslar'],
            ['word' => 'Russian language', 'translation' => 'rus dili'],

            ['word' => 'Great Britain', 'translation' => 'Böyük Britaniya'],
            ['word' => 'British', 'translation' => 'britaniyalılar'],
            ['word' => 'British English', 'translation' => 'Britaniya ingiliscəsi'],

            ['word' => 'America', 'translation' => 'Amerika'],
            ['word' => 'Americans', 'translation' => 'amerikalılar'],
            ['word' => 'American English', 'translation' => 'Amerika ingiliscəsi'],

            ['word' => 'France', 'translation' => 'Fransa'],
            ['word' => 'French', 'translation' => 'fransızlar / fransız dili'],

            ['word' => 'Germany', 'translation' => 'Almaniya'],
            ['word' => 'Germans', 'translation' => 'almanlar'],
            ['word' => 'German language', 'translation' => 'alman dili'],

            ['word' => 'Italy', 'translation' => 'İtaliya'],
            ['word' => 'Italians', 'translation' => 'italyanlar'],
            ['word' => 'Italian language', 'translation' => 'italyan dili'],

            ['word' => 'Greece', 'translation' => 'Yunanıstan'],
            ['word' => 'Greek', 'translation' => 'yunanlar / yunan dili'],

            ['word' => 'Turkey', 'translation' => 'Türkiyə'],
            ['word' => 'Turkish', 'translation' => 'türklər / türk dili'],

            ['word' => 'Egypt', 'translation' => 'Misir'],
            ['word' => 'Egyptians', 'translation' => 'misirlilər'],
            ['word' => 'Arabic language', 'translation' => 'ərəb dili'],

            ['word' => 'Spain', 'translation' => 'İspaniya'],
            ['word' => 'Spanish', 'translation' => 'ispanlar / ispan dili'],

            ['word' => 'Japan', 'translation' => 'Yaponiya'],
            ['word' => 'Japanese', 'translation' => 'yaponlar / yapon dili'],

            ['word' => 'China', 'translation' => 'Çin'],
            ['word' => 'Chinese', 'translation' => 'çinlilər / çin dili'],

            ['word' => 'Australia', 'translation' => 'Avstraliya'],
            ['word' => 'Australians', 'translation' => 'avstraliyalılar'],
            ['word' => 'Australian English', 'translation' => 'Avstraliya ingiliscəsi'],

            // Capitals
            ['word' => 'Moscow', 'translation' => 'Moskva'],
            ['word' => 'London', 'translation' => 'London'],
            ['word' => 'Washington D.C.', 'translation' => 'Vaşinqton'],
            ['word' => 'Paris', 'translation' => 'Paris'],
            ['word' => 'Berlin', 'translation' => 'Berlin'],
            ['word' => 'Rome', 'translation' => 'Roma'],
            ['word' => 'Athens', 'translation' => 'Afina'],
            ['word' => 'Ankara', 'translation' => 'Ankara'],
            ['word' => 'Cairo', 'translation' => 'Qahirə'],
            ['word' => 'Madrid', 'translation' => 'Madrid'],
            ['word' => 'Tokyo', 'translation' => 'Tokio'],
            ['word' => 'Beijing', 'translation' => 'Pekin'],
            ['word' => 'Canberra', 'translation' => 'Kanberra'],

            // Common phrases
            ['word' => 'Where are you from?', 'translation' => 'Sən haradansan?'],
            ['word' => 'What is your nationality?', 'translation' => 'Milliyyətin nədir?'],
            ['word' => 'What language do you speak?', 'translation' => 'Hansı dildə danışırsan?'],
            ['word' => 'What is the capital of your country?', 'translation' => 'Ölkənin paytaxtı nədir?'],
            ['word' => 'What is your country famous for?', 'translation' => 'Ölkən nə ilə məşhurdur?'],
            ['word' => 'Let me introduce myself', 'translation' => 'İcazə ver özümü təqdim edim'],
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
