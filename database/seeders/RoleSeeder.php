<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (['admin', 'pharmacy', 'user'] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'sanctum']);
        }
    }
}
//php artisan db:seed --class=RoleSeeder   
