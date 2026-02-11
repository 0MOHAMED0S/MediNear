<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'hoesen15@gmail.com'], 
            [
                'name' => 'Admin',
                'provider' => 'google',
                'provider_id' => '118112977175797173702',  
            ]
        );
    }
}