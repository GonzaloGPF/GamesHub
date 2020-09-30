<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class PopularGames extends Component
{
    public $popularGames = [];

    public function loadPopularGames()
    {
        $after = today()->addMonths(2)->timestamp;
        $before = today()->subMonths(2)->timestamp;
        $response = Http::withHeaders(['user-key' => config('services.igdb.user_key')])
            ->withOptions([
                'body' => "
                fields name, first_release_date, popularity, platforms.abbreviation, cover.url, rating, slug;
                where platforms = (48,49,130,6) & (first_release_date >= {$before} & first_release_date < {$after});
                sort popularity desc; 
                limit 12;"
            ])
            ->get('https://api-v3.igdb.com/games')
            ->json();

        $this->popularGames = $this->formatData($response);

        collect($this->popularGames)
            ->filter(fn($gameData) => $gameData['rating'] ?? false)
            ->each(fn($gameData) => $this->emitEvent($gameData));
    }

    /**
     * @param $data
     * @return array
     */
    private function formatData($data)
    {
        return collect($data)
            ->map(function ($gameData) {
                return collect($gameData)
                    ->merge([
                        'cover_url' => Str::replaceFirst('thumb', 'cover_big', $gameData['cover']['url'] ?? ''),
                        'rating' => isset($gameData['rating']) ? round($gameData['rating']) : null,
                        'platforms' => implode(', ', array_column($gameData['platforms'], 'abbreviation'))
                    ]);
            })->toArray();
    }

    /**
     * @param array $data
     */
    private function emitEvent(array $data)
    {
        $this->emit('gameWithRatingAdded', [
            'slug' => $data['slug'],
            'rating' => $data['rating'] / 100
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.popular-games');
    }
}
