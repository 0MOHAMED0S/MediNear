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
                'name' => 'Electronics',
                'image' => 'electronics.jpg',
                'description' => 'Devices and gadgets',
                'is_active' => true,
            ],
            [
                'name' => 'Books',
                'image' => 'books.jpg',
                'description' => 'All kinds of books',
                'is_active' => true,
            ],
            [
                'name' => 'Clothing',
                'image' => 'clothing.jpg',
                'description' => 'All kinds of clothing',
                'is_active' => true,
            ],
    ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
