<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EscapeRoom;

class EscapeRoomDetailsTest extends TestCase
{
    use RefreshDatabase;

    public function testRetrieveEscapeRoomById()
    {
        $escapeRoom = EscapeRoom::factory()->create();

        $response = $this->get("/api/escape-rooms/{$escapeRoom->id}");

        $response->assertStatus(200);

        // Assert the JSON response
        $response->assertJson([
            'Status' => true,
            'Escape_Room' => [
                'id' => $escapeRoom->id,
                'theme' => $escapeRoom->theme,
                'max_participants' => $escapeRoom->max_participants,
                'created_at' => $escapeRoom->created_at->toISOString(),
                'updated_at' => $escapeRoom->updated_at->toISOString(),
            ],
        ]);

    }
}
