<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Models\Branch::factory()
            ->count(47)
            ->create();
    }
}
