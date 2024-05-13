<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    public function run()
    {
        Address::create([
            'address' => '1745 T Street Southeast',
            'city' => 'Washington',
            'coordinates' => [
                'lat' => 38.867033,
                'lng' => -76.979235,
            ],
            'postal_code' => '20020',
            'state' => 'DC',
        ]);
    }
}
