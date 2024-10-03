<?php

namespace Database\Seeders;

use App\Models\Sadmin\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Feature::create(['name' => 'Limited access']);
        Feature::create(['name' => '10 users']);
        Feature::create(['name' => 'Extended access']);
        Feature::create(['name' => '50 users']);
        Feature::create(['name' => 'Full access']);
        Feature::create(['name' => 'Unlimited users']);
    }
}
