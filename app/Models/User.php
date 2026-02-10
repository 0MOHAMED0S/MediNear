<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Guard for spatie roles
     */
    protected $guard_name = 'sanctum';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
         'avatar',
        'email',
        'provider',
        'provider_id',
        'latitude',
        'longitude',
        'is_active',
    ];
protected $appends = ['role'];

public function getRoleAttribute()
{
    return $this->getRoleNames()->first();
}
    /**
     * Hidden attributes
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
