<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\Models\EscapeRoom;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    /**
     * Display a listing of Time Slots.
     */
    public function index($id)
    {
        $escapeRoom = EscapeRoom::findOrFail($id);
        $timeSlots = $escapeRoom->timeSlots;
        return response()->json([
            'status'=> true,
            'time_slots'=> $timeSlots
        ]);
    }
}
