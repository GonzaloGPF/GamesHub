<div class="game flex">
    <a href="{{ route('games.show', $game['slug'] ?? null) }}">
        <img src="{{ $game['cover_url']}}"
             alt="{{ $game['name'] }}"
             class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="ml-4">
        <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
        <div class="text-gray-400 text-sm mt-1">{{ $game['release_date'] }}</div>
    </div>
</div>