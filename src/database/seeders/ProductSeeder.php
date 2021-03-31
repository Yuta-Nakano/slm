<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Models\Product::factory()
            ->count(100)
            ->create();
    }
}
