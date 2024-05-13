<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Crypto;

class CryptoFactory extends Factory
{
    protected $model = Crypto::class;

    public function definition()
    {
        return [
            'coin' => $this->faker->word,
            'wallet' => $this->faker->uuid,
            'network' => $this->faker->randomElement(['Bitcoin', 'Ethereum', 'Ripple', 'Litecoin', 'Dogecoin']),
        ];
    }
}
