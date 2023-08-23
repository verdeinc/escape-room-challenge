<?php
namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Run migrations and seed the database before each test
        $this->artisan('migrate:fresh --seed');
    }

    /**
     * Sign in a user and return the authenticated user.
     */
    protected function signIn()
    {
        $user = \App\Models\User::factory()->create();
        Auth::login($user);

        return $user;
    }

    /**
     * Create a new booking for testing.
     */
    protected function createBooking($user, $escapeRoom, $timeSlot)
    {
        return \App\Models\Booking::create([
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoom->id,
            'time_slot_id' => $timeSlot->id,
        ]);
    }

}
