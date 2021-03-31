<?php

namespace Database\Factories;

use App\Models;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Models\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userRand = Models\User::get()->random()->id;
        return [
            'code'               => $this->faker->unique()->bothify('???###'),
            'name'               => $this->faker->unique()->lexify('Goods????'),
            'remarks'            => $this->faker->optional()->realText,
            'registrant_user_id' => $userRand,
            'updated_user_id'    => $userRand,
        ];
    }
}
