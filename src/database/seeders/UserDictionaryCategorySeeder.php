<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDictionaryCategory;
use Illuminate\Database\Seeder;

class UserDictionaryCategorySeeder extends Seeder
{
    public const DEFAULT_CATEGORY = 'Mənim sözlərim';

    public function run(): void
    {
        User::each(function (User $user) {
            UserDictionaryCategory::firstOrCreate([
                'user_id' => $user->id,
                'title'   => self::DEFAULT_CATEGORY,
            ]);
        });
    }
}
