<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\EscapeRoom;
use Illuminate\Http\Request;

class EscapeRoomController extends Controller
{
    /**
     * Display a listing of Escape Rooms.
     */
    public function index()
    {
        $escapeRooms = EscapeRoom::all();
        return response()->json([
            'Status'=> true,
            'Escape_Rooms_Lists'=> $escapeRooms
        ]);
    }

    /**
     * Display the specified Escape Room.
     */
    public function show($id)
    {
        $escapeRoom = EscapeRoom::findOrFail($id);
        return response()->json([
            'Status'=> true,
            'Escape_Room'=> $escapeRoom
        ]);
    }

}
