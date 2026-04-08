<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'model_year',
        'category_id',
        'sub_category_id',
        'daily_rate',
        'quantity',
        'status',
        'description',
        'fuel_type',
        'transmission',
        'seating_capacity',
        'thumbnail',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($vehicle) {
            if (empty($vehicle->slug)) {
                $vehicle->slug = Str::slug($vehicle->name).'-'.Str::random(5);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
