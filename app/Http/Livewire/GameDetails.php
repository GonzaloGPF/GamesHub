<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class GameDetails extends Component
{
    /**
     * @var array
     */
    public $game = [];

    public function mount($slug)
    {
        $response = Http::withHeaders(['user-key' => config('services.igdb.user_key')])
            ->withOptions([
                'body' => "
                fields *, rating, cover.url, platforms.abbreviation, genres.name, involved_companies.company.*, videos.video_id, screenshots.url, similar_games.*, similar_games.cover.url, similar_games.platforms.abbreviation, websites.url;
                where slug = \"{$slug}\";
                "
            ])
            ->get('https://api-v3.igdb.com/games')
            ->json();

        abort_if(!$response, 404);

        $this->game = $this->formatGame($response[0]);
    }

    /**
     * @param $gameData
     * @return array
     */
    private function formatGame($gameData)
    {
        return collect($gameData)
            ->merge([
                'cover_url' => Str::replaceFirst('thumb', 'cover_big', $gameData['cover']['url'] ?? ''),
                'rating' => isset($gameData['rating']) ? round($gameData['rating']) : 0,
                'criticRating' => isset($gameData['aggregated_rating']) ? round($gameData['aggregated_rating']) : 0,
                'platforms' => implode(', ', array_column($gameData['platforms'], 'abbreviation')),
                'genre_names' => implode(' . ', array_column($gameData['genres'], 'name')),
                'company_names' => array_column($gameData['involved_companies'], 'company')[0]['name'] ?? null,
                'trailer' => isset($gameData['videos']) ? "https://youtube.com/watch/{$gameData['videos'][0]['video_id']}" : null,
                'screenshots' => collect($gameData['screenshots'])
                    ->map(function ($screenshotData) {
                        return [
                            'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshotData['url'] ?? ''),
                            'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshotData['url'] ?? ''),
                        ];
                    })->take(9),
                'similar_games' => collect($gameData['similar_games'])
                    ->map(function ($similarGameData) {
                        return [
                            'name' => $similarGameData['name'],
                            'slug' => $similarGameData['slug'],
                            'cover_url' => isset($similarGameData['cover']) ? Str::replaceFirst('thumb', 'cover_big', $similarGameData['cover']['url'] ?? '') : 'https://via.placeholder.com/264x352',
                            'rating' => isset($similarGameData['rating']) ? round($similarGameData['rating']) : 0,
                            'platforms' => implode(', ', array_column($similarGameData['platforms'], 'abbreviation'))
                        ];
                    })->take(6),
                'social' => [
                    'official' => collect($gameData['websites'])->first(),
                    'facebook' => collect($gameData['websites'])->filter(function ($website) {
                        return Str::contains($website['url'], 'facebook');
                    })->first(),
                    'instagram' => collect($gameData['websites'])->filter(function ($website) {
                        return Str::contains($website['url'], 'instagram');
                    })->first(),
                    'twitter' => collect($gameData['websites'])->filter(function ($website) {
                        return Str::contains($website['url'], 'twitter');
                    })->first(),
                ]
            ])->toArray();
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.game-details');
    }
}
