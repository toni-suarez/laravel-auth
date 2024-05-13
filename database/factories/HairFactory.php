<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hair;

class HairFactory extends Factory
{
    protected $model = Hair::class;

    public function definition()
    {
        return [
            'color' => $this->faker->colorName,
            'type' => $this->faker->randomElement(['Strands', 'Curly', 'Straight', 'Wavy']),
        ];
    }
}
