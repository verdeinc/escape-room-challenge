<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

use Database\Factories\EscapeRoomFactory;
use Database\Factories\TimeSlotFactory;
use Illuminate\Database\Seeder;

// Import other factory classes
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        EscapeRoomFactory::factoryForModel(EscapeRoom::class)->count(3)->create();
        TimeSlotFactory::factoryForModel(TimeSlot::class)->count(5)->create();
        // Create other factories
    }
}
