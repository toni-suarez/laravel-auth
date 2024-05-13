<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'coordinates' => [
                'lat' => $this->faker->latitude,
                'lng' => $this->faker->longitude,
            ],
            'postal_code' => $this->faker->postcode,
            'state' => $this->faker->state,
        ];
    }
}
