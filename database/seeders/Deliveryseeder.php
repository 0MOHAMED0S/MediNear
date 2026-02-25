<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delivery;

class DeliverySeeder extends Seeder
{
    public function run(): void
    {
        Delivery::updateOrCreate(
            ['email' => 'hoesen@gmail.com'],
            [
                'name' => 'hoesen',
                'delivery_fee' => 25,
                'status' => 'active',
            ]
        );

        Delivery::updateOrCreate(
            ['email' => 'sayed@gmail.com'],
            [
                'name' => 'sayed',
                'delivery_fee' => 30,
                'status' => 'active',
            ]
        );

        Delivery::updateOrCreate(
            ['email' => 'doaa@gmail.com'],
            [
                'name' => 'Doaa',
                'delivery_fee' => 35,
                'status' => 'inactive',
            ]
        );
    }
}