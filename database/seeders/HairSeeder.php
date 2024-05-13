<?php

use Illuminate\Database\Seeder;
use App\Models\Hair;

class HairSeeder extends Seeder
{
    public function run()
    {
        Hair::create([
            'color' => 'Black',
            'type' => 'Strands',
        ]);
    }
}
