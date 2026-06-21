<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@nicoville.org',
        ], [
            'name' => 'Nicoville Admin',
            'password' => env('ADMIN_PASSWORD', 'NicovilleAdmin@2026'),
            'is_admin' => true,
        ]);
    }
}
