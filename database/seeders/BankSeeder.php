<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    public function run()
    {
        Bank::create([
            'card_expire' => '06/22',
            'card_number' => '50380955204220685',
            'card_type' => 'maestro',
            'currency' => 'Peso',
            'iban' => 'NO17 0695 2754 967',
        ]);
    }
}
