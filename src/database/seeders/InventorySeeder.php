<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Models\Inventory::factory()
            ->count(60)
            ->create();
    }
}
