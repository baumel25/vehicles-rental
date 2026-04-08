<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'amount',
        'phone_number',
        'status',
        'external_reference',
        'type',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
