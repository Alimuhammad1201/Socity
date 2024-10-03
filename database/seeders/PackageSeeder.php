<?php

namespace Database\Seeders;

use App\Models\Sadmin\Packages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Packages::create([
            'name' => 'basic',
            'features' => json_encode(['Limited access', '10 users']),
            'price' => 10.00,
            'duration' => 30,
            'stripe_price_id' => '1',
        ]);

        Packages::create([
            'name' => 'premium',
            'features' => json_encode(['Extended access', '50 users']),
            'price' => 20.00,
            'duration' => 30,
            'stripe_price_id' => '2',
        ]);

        Packages::create([
            'name' => 'elite',
            'features' => json_encode(['Full access', 'Unlimited users']),
            'price' => 30.00,
            'duration' => 30,
            'stripe_price_id' => '3',
        ]);

    }
}
