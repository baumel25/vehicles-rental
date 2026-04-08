<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'license_number',
        'experience_years',
        'base_rate',
        'status',
        'biography',
        'profile_picture',
    ];
}
