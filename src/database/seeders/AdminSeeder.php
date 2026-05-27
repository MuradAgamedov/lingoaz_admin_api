<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'agamedov94@mail.ru'],
            [
                'name' => 'Murad Agamedov',
                'password' => Hash::make('Esmeresmer55$'),
            ]
        );
    }
}