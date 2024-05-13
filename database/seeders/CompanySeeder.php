<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'name' => 'Blanda-O\'Keefe',
            'department' => 'Marketing',
            'title' => 'Help Desk Operator',
            'address' => '629 Debbie Drive',
            'city' => 'Nashville',
            'latitude' => 36.208114,
            'longitude' => -86.58621199999999,
            'postal_code' => '37076',
            'state' => 'TN',
        ]);
    }
}
