<?php

namespace Database\Seeders;
// name \App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

$categories = [
            [
                'name' => 'Pain Relief',
                'image' => 'pain_relief.jpg',
                'description' => 'Medicines for headache, muscle pain and fever',
                'is_active' => true,
            ],
            [
                'name' => 'Antibiotics',
                'image' => 'antibiotics.jpg',
                'description' => 'Medicines used to treat bacterial infections',
                'is_active' => true,
            ],
            [
                'name' => 'Vitamins & Supplements',
                'image' => 'vitamins.jpg',
                'description' => 'Vitamins, minerals and dietary supplements',
                'is_active' => true,
            ],
            [
                'name' => 'Baby Care',
                'image' => 'baby_care.jpg',
                'description' => 'Products for babies and infants',
                'is_active' => true,
            ],
            [
                'name' => 'Skin Care',
                'image' => 'skin_care.jpg',
                'description' => 'Creams, lotions and dermatological products',
                'is_active' => true,
            ],
            [
                'name' => 'Medical Equipment',
                'image' => 'medical_equipment.jpg',
                'description' => 'Devices like thermometers, blood pressure monitors, etc.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
