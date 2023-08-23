<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing Bookings.
     */
    public function index()
    {
        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->get();
        return response()->json($bookings);
    }

    /**
     * Store a new Booking.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $escapeRoomId = $request->input('escape_room_id');
        $timeSlotId = $request->input('time_slot_id');

        $escapeRoom = EscapeRoom::findOrFail($escapeRoomId);
        $timeSlot = TimeSlot::findOrFail($timeSlotId);

        if (!$timeSlot->isAvailable() || $timeSlot->participants_count >= $escapeRoom->max_participants) {
            return response()->json([
                'status' => false,
                'message' => 'Time slot is not available or full'
            ],400);
        }

        $existingBooking = Booking::where('user_id', $user->id)
            ->where('time_slot_id', $timeSlotId)
            ->first();

        if ($existingBooking) {
            return response()->json([
                'status' => false,
                'message' => 'You already have a booking for this time slot'
            ],400);
        }

        // Calculate discount if it's the user's birthday
        $isBirthday = $user->isBirthday();
        $discount = $isBirthday ? 0.1 : 0;

        $booking = new Booking([
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoomId,
            'time_slot_id' => $timeSlotId,
            'discount' => $discount,
        ]);

        $timeSlot->participants_count++;
        $timeSlot->save();

        $booking->save();

        return response()->json(['message' => 'Booking created successfully']);
    }

    /**
     * Delete a Booking.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $booking = Booking::where('user_id', $user->id)
            ->where('id', $id)
            ->firstOrFail();

        $timeSlot = $booking->timeSlot;
        $timeSlot->participants_count--;
        $timeSlot->save();

        $booking->delete();

        return response()->json(['message' => 'Booking canceled successfully']);
    }
}
