<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Medicine;
use App\Models\Category;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        // create categories if they don't exist
        $painRelief = Category::firstOrCreate(
            ['name' => 'Pain Relief'],
            [
                'image' => 'pain.jpg',
                'description' => 'Pain relief medicines',
                'is_active' => true
            ]
        );

        $antibiotics = Category::firstOrCreate(
            ['name' => 'Antibiotics'],
            [
                'image' => 'antibiotics.jpg',
                'description' => 'Antibiotic medicines',
                'is_active' => true
            ]
        );

        $vitamins = Category::firstOrCreate(
            ['name' => 'Vitamins & Supplements'],
            [
                'image' => 'vitamins.jpg',
                'description' => 'Vitamins and supplements',
                'is_active' => true
            ]
        );

        $medicines = [
            [
                'name' => 'Panadol Extra',
                'description' => 'Used for headache and fever relief',
                'manufacturer' => 'GSK',
                'barcode' => '111111111111',
                'category_id' => $painRelief->id,
            ],
            [
                'name' => 'Brufen 400mg',
                'description' => 'Anti-inflammatory pain relief medicine',
                'manufacturer' => 'Abbott',
                'barcode' => '222222222222',
                'category_id' => $painRelief->id,
            ],
            [
                'name' => 'Augmentin 1g',
                'description' => 'Antibiotic for bacterial infections',
                'manufacturer' => 'GSK',
                'barcode' => '333333333333',
                'category_id' => $antibiotics->id,
            ],
            [
                'name' => 'C-Vit 1000mg',
                'description' => 'Vitamin C supplement',
                'manufacturer' => 'Eva Pharma',
                'barcode' => '444444444444',
                'category_id' => $vitamins->id,
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::updateOrCreate(
                ['name' => $medicine['name']], // unique field
                [
                    'slug' => Str::slug($medicine['name']),
                    'image' => null,
                    'description' => $medicine['description'],
                    'status' => true,
                    'manufacturer' => $medicine['manufacturer'],
                    'barcode' => $medicine['barcode'],
                    'category_id' => $medicine['category_id'],
                ]
            );
        }
    }
}