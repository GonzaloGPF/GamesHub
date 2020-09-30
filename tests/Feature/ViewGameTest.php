<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ViewGameTest extends TestCase
{
    /** @test */
    function it_can_get_a_game_by_slug()
    {
//        Http::fake([
//            'https://api-v3.igdb.com/games' => $this->>fakeResponse()
//        ]);
        $response = $this->get(route('games.show', 'the-last-of-us-part-ii'))
            ->assertSuccessful();
    }

    private function fakeResponse()
    {
        return Http::response([]);
    }
}
