<?php

namespace Tests\Feature;

use App\Http\Livewire\PopularGames;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewPopularGamesTest extends TestCase
{
    /** @test */
    function it_can_view_popular_games()
    {
//        Http::fake([
//            'https://api-v3.igdb.com/games' => $this->>fakeResponse()
//        ]);
        Livewire::test(PopularGames::class)
            ->assertSet('popularGames', [])
            ->call('loadPopularGames')
            ->assertSee('Some Game Title');
    }

    private function fakeResponse()
    {
        return Http::response([]);
    }
}
