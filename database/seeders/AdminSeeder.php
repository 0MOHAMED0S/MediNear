<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // create or get the admin role
        $role = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'sanctum'
        ]);

        // First Admin
        $admin1 = User::updateOrCreate(
            ['email' => 'hoesen15@gmail.com'],
            [
                'name' => 'Hussien',
                'provider' => 'google',
                'provider_id' => '118112977175797173702',
            ]
        );

        $admin1->assignRole('admin');

        // Second Admin (New User)
        $admin2 = User::updateOrCreate(
            ['email' => 'msa0back@gmail.com'],
            [
                'name' => 'Mohamed Sayed',
                'provider' => 'google',
                'provider_id' => '102736598776507148394',
            ]
        );

        $admin2->assignRole('admin');
    }
}
