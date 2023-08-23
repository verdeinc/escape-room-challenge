<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class BookingListTest extends TestCase
{
    use RefreshDatabase;

    public function testListUserBookings()
    {
        $user = User::factory()->create();
        // Create bookings associated with the user

        $response = $this->actingAs($user)->get('/api/bookings');

        $response->assertStatus(200);
    }
}

