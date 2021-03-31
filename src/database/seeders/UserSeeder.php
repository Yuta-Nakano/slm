<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'abs@example.org',
            ]);

        Models\User::factory()
            ->count(16)
            ->create();
    }
}
