<?php

namespace Database\Seeders;

use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class DictionaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Weather and Seasons',
            'Family and Friends',
            'Appearance',
            'Character',
            'Mood',
            'My Day and Household Chores',
            'School',
            'Hobbies and Free Time',
            'Books',
            'Food',
            'Clothing',
            'Nature',
            'Travel',
            'Holidays',
            'Countries and Nationalities',
            'Professions',
            'Sports',
            'Parties',
            'Home',
            'City',
        ];

        foreach ($categories as $category) {
            DictionaryCategory::create([
                'title' => $category,
            ]);
        }
    }
}
