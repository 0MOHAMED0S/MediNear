<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pharmacy;
use App\Models\PharmacyApplication;

class PharmaciesSeeder extends Seeder
{
    public function run(): void
    {
        $applications = PharmacyApplication::where('status', 'approved')->get();

        foreach ($applications as $application) {
            // Skip if pharmacy already exists
            Pharmacy::updateOrCreate(
                ['pharmacy_application_id' => $application->id],
                [
                    'pharmacy_application_id' => $application->id,
                    'pharmacy_name' => $application->pharmacy_name,
                    'owner_name' => $application->owner_name,
                    'phone_number' => $application->phone_number,
                    'address' => $application->address,
                    'latitude' => $application->latitude,
                    'longitude' => $application->longitude,
                    'license_number' => $application->license_number,
                    'license_image' => $application->license_image,
                    'commercial_number' => $application->commercial_number,
                    'national_id_number' => $application->national_id_number,
                    'expiration_date' => $application->expiration_date,
                    'opening_time' => $application->opening_time,
                    'closing_time' => $application->closing_time,
                    'is_24_hours' => $application->is_24_hours,
                    'is_delivery' => $application->is_delivery,
                    'is_active' => true,
                ]
            );
        }
    }
}
