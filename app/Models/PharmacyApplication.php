<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PharmacyApplication extends Model
{
    protected $fillable = [
        'user_id',
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
        'status',
    ];

    protected $casts = [
        'is_24_hours' => 'boolean',
        'is_delivery' => 'boolean',
        'expiration_date' => 'date',
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
    ];

    // relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //  open now attribute
    public function getIsOpenNowAttribute()
    {
        if ($this->is_24_hours) {
            return true;
        }

        if (!$this->opening_time || !$this->closing_time) {
            return false;
        }

        $now = now()->format('H:i');

        return $now >= $this->opening_time->format('H:i')
            && $now <= $this->closing_time->format('H:i');
    }
}