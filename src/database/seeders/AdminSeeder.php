<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::where('email', 'agamedov94@mail.ru')->delete();

        User::create([
            'name'     => 'Murad Agamedov',
            'email'    => 'agamedov94@mail.ru',
            'password' => Hash::make('Esmeresmer55$'),
            'is_admin' => true,
        ]);
    }
}