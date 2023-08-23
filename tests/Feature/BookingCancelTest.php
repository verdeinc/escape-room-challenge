<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Booking;

class BookingCancelTest extends TestCase
{
    use RefreshDatabase;

    public function testCancelBooking()
    {
        $user = $this->signIn();
        $escapeRoom = \App\Models\EscapeRoom::factory()->create();
        $timeSlot = \App\Models\TimeSlot::factory()->create(['escape_room_id' => $escapeRoom->id]);
        $booking = $this->createBooking($user, $escapeRoom, $timeSlot);

        $response = $this->actingAs($user)->delete("/api/bookings/{$booking->id}");

        // Assert that the response status code is 200 (OK)
        $response->assertStatus(200);

        // Assert that the response contains the expected JSON structure
        $response->assertJsonStructure([
            'message',
            // Add other expected fields
        ]);

        // Assert that the booking was deleted from the database
        $this->assertDatabaseMissing('bookings', [
            'id' => $booking->id,
        ]);

    }
}

