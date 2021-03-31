<?php

namespace Database\Factories;

use App\Models;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Models\Branch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userRand   = Models\User::get()->random()->id;
        $prefecture = $this->faker->prefecture;
        $brunchName = $prefecture . $this->faker->city;
        return [
            'name'        => $brunchName,
            'postal_code'        => $this->faker->postcode,
            'prefecture'         => $prefecture,
            'municipality'       => $this->faker->city . ' ' . $this->faker->ward,
            'address'            => $this->faker->streetAddress,
            'building'           => $this->faker->secondaryAddress,
            'charge_name'        => $this->faker->lastName . ' ' . $this->faker->firstName,
            'phone_number'       => $this->faker->phoneNumber,
            'remarks'            => $this->faker->optional()->realText,
            'registrant_user_id' => $userRand,
            'updated_user_id'    => $userRand,
        ];
    }
}
