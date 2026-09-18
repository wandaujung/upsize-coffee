<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'booking_date',
        'booking_time',
        'people',
        'room',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}