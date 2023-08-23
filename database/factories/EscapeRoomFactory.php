<?php

namespace Database\Factories;

use App\Models\EscapeRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class EscapeRoomFactory extends Factory
{
    protected $model = EscapeRoom::class;

    public function definition()
    {
        return [
            'theme' => $this->faker->word,
            'max_participants' => $this->faker->numberBetween(2, 8),
        ];
    }
}
