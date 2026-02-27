<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'description' => 'Medications for relieving pain and fever',
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
                'description' => 'Nutritional supplements and vitamins',
                'is_active' => true,
            ],
            [
                'name' => 'Cold & Flu',
                'image' => 'cold_flu.jpg',
                'description' => 'Medicines for cold and flu symptoms',
                'is_active' => true,
            ],
            [
                'name' => 'Digestive System',
                'image' => 'digestive.jpg',
                'description' => 'Medications for stomach and digestive issues',
                'is_active' => true,
            ],
            [
                'name' => 'Diabetes',
                'image' => 'diabetes.jpg',
                'description' => 'Medicines and supplies for diabetes patients',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
