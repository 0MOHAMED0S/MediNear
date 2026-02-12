<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        //create or get the admin role  
        $role = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'sanctum'
        ]);

        //create or update the admin user
        $user = User::updateOrCreate(
            ['email' => 'hoesen15@gmail.com'],
            [
                'name' => 'Hussien',
                'provider' => 'google',
                'provider_id' => '118112977175797173702',
            ]
        );

       //meke sure the user has the admin role
        $user->assignRole('admin');
    }
}