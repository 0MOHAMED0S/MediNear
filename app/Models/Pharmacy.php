<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = [
        'pharmacy_application_id',
        'pharmacy_name',
        'owner_name',
        'phone_number',
        'address',
        'latitude',
        'longitude',
        'license_number',
        'license_image',
        'commercial_number',
        'national_id_number',
        'expiration_date',
        'opening_time',
        'closing_time',
        'is_24_hours',
        'is_delivery',
        'is_active',
    ];

    public function pharmacyApplication()
    {
        return $this->belongsTo(PharmacyApplication::class);
    }
}
