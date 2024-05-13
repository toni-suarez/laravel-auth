<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bank;

class BankFactory extends Factory
{
    protected $model = Bank::class;

    public function definition()
    {
        return [
            'card_expire' => $this->faker->creditCardExpirationDate,
            'card_number' => $this->faker->creditCardNumber,
            'card_type' => $this->faker->creditCardType,
            'currency' => $this->faker->currencyCode,
            'iban' => $this->faker->iban,
        ];
    }
}
