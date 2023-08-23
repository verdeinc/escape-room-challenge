<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;

class EscapeRoomTimeSlotTest extends TestCase
{
    use RefreshDatabase;

    public function testListAvailableTimeSlots()
    {
        $escapeRoom = EscapeRoom::factory()->create();
        $timeSlots = TimeSlot::factory()->count(2)->create(['escape_room_id' => $escapeRoom->id]);

        // Make a request to endpoint
        $response = $this->get("/api/escape-rooms/{$escapeRoom->id}/time-slots");

        // Assert the response status
        $response->assertStatus(200);

        // Assert the JSON response
        $response->assertJson([
            'status' => true,
            'time_slots' => $timeSlots->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'escape_room_id' => $slot->escape_room_id,
                    'start_time' => $slot->start_time->format('Y-m-d H:i:s'),
                    'end_time' => $slot->end_time->format('Y-m-d H:i:s'),
                    'participants_count' => $slot->participants_count,
                    'created_at' => $slot->created_at->toISOString(),
                    'updated_at' => $slot->updated_at->toISOString(),
                ];
            })->toArray(),
        ]);
    }
}
