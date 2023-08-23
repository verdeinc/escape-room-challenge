<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EscapeRoom;

class EscapeRoomTest extends TestCase
{
    use RefreshDatabase;
    protected function createEscapeRoom(array $attributes = [])
    {
        $escapeRoom=EscapeRoom::factory()->count(3)->create();

        $response = $this->get('/api/escape-rooms');

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
        $response->assertJson([
            'Status' => true,
            'Escape_Room' => [
                'id' => $escapeRoom->id,
                'theme' => $escapeRoom->theme,
                'max_participants' => $escapeRoom->max_participants,
            ]
        ]);
    }
}
