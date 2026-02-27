<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles if they don't exist
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'sanctum']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'sanctum']);
        Role::firstOrCreate(['name' => 'pharmacy', 'guard_name' => 'sanctum']);

        // Admins
        $admin1 = User::updateOrCreate(
            ['email' => 'hoesen15@gmail.com'],
            [
                'name' => 'Hussien',
                'provider' => 'google',
                'provider_id' => '118112977175797173702',
            ]
        );
        $admin1->assignRole('admin');

        $admin2 = User::updateOrCreate(
            ['email' => 'msa0back@gmail.com'],
            [
                'name' => 'Mohamed Sayed',
                'provider' => 'google',
                'provider_id' => '102736598776507148394',
            ]
        );
        $admin2->assignRole('admin');

        // Normal Google User
        $normalUser = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Normal User',
                'provider' => 'google',
                'provider_id' => '100000000000000000000', // fake Google ID
            ]
        );
        $normalUser->assignRole('user');
    }
}
