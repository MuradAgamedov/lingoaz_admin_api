<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteSpecificUser extends Command
{
    /**
     * Command name
     */
    protected $signature = 'user:delete-maga';

    /**
     * Command description
     */
    protected $description = 'Delete user with email maga.mamedov.2001@bk.ru';

    /**
     * Execute the command.
     */
    public function handle()
    {
        $user = User::where('email', 'maga.mamedov.2001@bk.ru')->first();

        if (!$user) {
            $this->error('User tapilmadi.');
            return;
        }

        $user->delete();

        $this->info('User ugurla silindi.');
    }
}
