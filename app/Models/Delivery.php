<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
     // name,email,delivery_fee,status
    protected $fillable = [
        'name',
        'email',
        'delivery_fee',
        'status',
    ];
}
