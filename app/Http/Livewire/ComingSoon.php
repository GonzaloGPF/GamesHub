<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class ComingSoon extends Component
{
    public $comingSoon = [];

    public function loadComingSoon()
    {
        $current = today()->timestamp;

        $response = Http::withHeaders(['user-key' => config('services.igdb.user_key')])
            ->withOptions([
                'body' => "
                fields name, first_release_date, popularity, platforms.abbreviation, cover.url, rating, rating_count, summary, slug;
                where platforms = (48,49,130,6) & (first_release_date >= {$current} & popularity > 5);
                sort first_release_date asc; 
                limit 4;"
            ])
            ->get('https://api-v3.igdb.com/games')
            ->json();

        $this->comingSoon = $this->formatData($response);
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
                        'cover_url' => Str::replaceFirst('thumb', 'cover_small', $gameData['cover']['url'] ?? ''),
                        'rating' => isset($gameData['rating']) ? round($gameData['rating']).'%' : null,
                        'platforms' => implode(', ', array_column($gameData['platforms'], 'abbreviation')),
                        'release_date' => Carbon::parse($gameData['first_release_date'])->format('M d, Y')
                    ]);
            })->toArray();
    }


    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.coming-soon');
    }
}
