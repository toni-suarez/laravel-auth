<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'department' => $this->faker->word,
            'title' => $this->faker->jobTitle,
            'address_id' => function () {
                return Address::factory()->create()->id;
            },
        ];
    }
}
