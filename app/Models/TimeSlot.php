<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'escape_room_id', 'start_time', 'end_time',
    ];

    public function escapeRoom()
    {
        return $this->belongsTo(EscapeRoom::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailable()
    {
        // Check if the current time slot is in the future
        if ($this->start_time > now()) {
            // Check if the time slot has reached its maximum participants
            if ($this->participants_count < $this->escapeRoom->max_participants) {
                return true; // Time slot is available
            }
        }

        return false; // Time slot is not available
    }
}
