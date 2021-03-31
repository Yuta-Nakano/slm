<?php

namespace Database\Factories;

use App\Models;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Models\Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $branchId  = Models\Branch::get()->random()->id;
        $productId = Models\Product::get()->random()->id;
        return [
            'branch_id'  => $branchId,
            'product_id' => $productId,
        ];
    }
}
