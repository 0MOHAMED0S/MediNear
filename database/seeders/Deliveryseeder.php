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
                'image' => 'hoesen.jpg',
                'delivery_fee' => 25,
                'status' => 'active',
            ]
        );

        Delivery::updateOrCreate(
            ['email' => 'sayed@gmail.com'],
            [
                'name' => 'sayed',
                'image' => 'sayed.jpg',
                'delivery_fee' => 30,
                'status' => 'active',
            ]
        );

        Delivery::updateOrCreate(
            ['email' => 'doaa@gmail.com'],
            [
                'name' => 'Doaa',
                'image' => 'doaa.jpg',
                'delivery_fee' => 35,
                'status' => 'inactive',
            ]
        );
    }
}