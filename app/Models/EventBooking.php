<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    protected $fillable = [
        'event_slug',
        'event_title',
        'name',
        'email',
        'phone',
        'attendance_type',
        'guests',
        'message',
        'status',
    ];
}
