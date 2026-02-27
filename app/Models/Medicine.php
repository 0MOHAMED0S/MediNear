<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status',
        'category_id',
        'manufacturer',
        'barcode',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($medicine) {
            $medicine->slug = Str::slug($medicine->name);
        });

        static::updating(function ($medicine) {
            $medicine->slug = Str::slug($medicine->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
