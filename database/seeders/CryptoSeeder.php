<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Crypto;

class CryptoSeeder extends Seeder
{
    public function run()
    {
        Crypto::create([
            'coin' => 'Bitcoin',
            'wallet' => '0xb9fc2fe63b2a6c003f1c324c3bfa53259162181a',
            'network' => 'Ethereum (ERC20)',
        ]);
    }
}
