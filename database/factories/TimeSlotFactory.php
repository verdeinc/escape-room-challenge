<?php


namespace Database\Factories;

use App\Models\TimeSlot;
use App\Models\EscapeRoom;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimeSlotFactory extends Factory
{
    protected $model = TimeSlot::class;

    public function definition()
    {
        return [
            'escape_room_id' => EscapeRoom::factory(),
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime(),
        ];
    }
}
