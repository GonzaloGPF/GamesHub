<div class="game-mt-8">
    <div class="relative inline-block">
        <a href="{{ route('games.show', $game['slug'] ?? null) }}">
            <img src="{{ $game['cover_url'] }}"
                 alt="{{ $game['name'] }}"
                 class="hover:opacity-75 transition ease-in-out duration-150">
        </a>
        @if($game['rating'])
            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"
                 style="right: -20px; bottom: -20px">
                <div id="{{ $game['slug'] }}" class="font-semibold text-xs flex justify-center items-center h-full">
                    @push('scripts')
                        @include('partials.rating', [
                            'slug' => $game['slug'],
                            'rating' => $game['rating'],
                            'event' => null
                        ])
                    @endpush

                </div>
            </div>
        @endif
    </div>
    <a href="{{ route('games.show', $game['slug'] ?? null) }}"
       class="block text-base font-semitbold leading-tight hover:text-gray-400 mt-8">{{ $game['name'] }}</a>
    <div class="text-gray-400 mt-1">
        {{ $game['platforms'] }}
    </div>
</div>