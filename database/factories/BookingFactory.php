<?php


namespace Database\Factories;

use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\EscapeRoom;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimeSlotFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'escape_room_id' => EscapeRoom::factory(),
            'time_slot_id' => TimeSlot::factory(),
            'discount' => $this->faker->randomElement([0, 0.1]),
        ];
    }
}
