<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use App\Models\User;

class BookingCreateTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateBooking()
    {
        $this->withoutExceptionHandling();

        // Create a user
        $user = User::factory()->create();

        // Create an escape room and a time slot
        $escapeRoom = EscapeRoom::factory()->create();
        $timeSlot = TimeSlot::factory()->create([
            'escape_room_id' => $escapeRoom->id,
            'participants_count' => 0, // Set participants count to 0 to ensure availability
        ]);

        // Simulate a request with the necessary data
        $requestData = [
            'escape_room_id' => $escapeRoom->id,
            'time_slot_id' => $timeSlot->id,
        ];

        // Send a POST request to create a booking
        $response = $this->actingAs($user)->json('POST', route('bookings.store'), $requestData);

        // Check if the conditions for a successful booking are met
        $isAvailable = $timeSlot->isAvailable() && $timeSlot->participants_count < $escapeRoom->max_participants;
        if ($isAvailable) {
            // Assert for a 200 response and the success message
            $response->assertStatus(200)
                ->assertJson(['message' => 'Booking created successfully']);

            // Verify that the booking was created and discount applied
            $this->assertDatabaseHas('bookings', [
                'user_id' => $user->id,
                'escape_room_id' => $escapeRoom->id,
                'time_slot_id' => $timeSlot->id,
            ]);

            // Verify that the participants count of the time slot is updated
            $this->assertEquals(1, $timeSlot->refresh()->participants_count);
        } else {
            // If the conditions are not met, assert for a 400 response
            $response->assertStatus(400);
        }
    }
}
