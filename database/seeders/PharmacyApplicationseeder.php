<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PharmacyApplication;
use App\Models\User;
use Carbon\Carbon;

class PharmacyApplicationseeder extends Seeder
{
    public function run(): void
    {
        // get a user with role user to associate with the pharmacy applications
        $user = User::role('user')->first();

        if (!$user) {
            return;
        }

        $applications = [
            [
                'user_id' => $user->id,
                'pharmacy_name' => 'El Shifa Pharmacy',
                'owner_name' => 'Ahmed Hassan',
                'phone_number' => '01012345678',
                'address' => 'Nasr City, Cairo',
                'latitude' => 30.0566100,
                'longitude' => 31.3300000,
                'license_number' => 'LIC123456',
                'license_image' => 'license1.jpg',
                'commercial_number' => 'COM123456',
                'national_id_number' => '29801011234567',
                'expiration_date' => Carbon::now()->addYears(2),
                'opening_time' => '08:00:00',
                'closing_time' => '23:00:00',
                'is_24_hours' => false,
                'is_delivery' => true,
                'status' => 'pending',
            ],
            [
                'user_id' => $user->id,
                'pharmacy_name' => 'Al Rahma Pharmacy',
                'owner_name' => 'Mohamed Ali',
                'phone_number' => '01198765432',
                'address' => 'Maadi, Cairo',
                'latitude' => 29.9602000,
                'longitude' => 31.2569000,
                'license_number' => 'LIC654321',
                'license_image' => 'license2.jpg',
                'commercial_number' => 'COM654321',
                'national_id_number' => '29705051234567',
                'expiration_date' => Carbon::now()->addYear(),
                'opening_time' => null,
                'closing_time' => null,
                'is_24_hours' => true,
                'is_delivery' => true,
                'status' => 'approved',
            ],
        ];

        foreach ($applications as $application) {
            PharmacyApplication::updateOrCreate(
                ['commercial_number' => $application['commercial_number']], // unique field
                $application
            );
        }
    }
}