<div wire:init="loadPopularGames">
    <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Popular Games</h2>
    <div class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12 border-b border-gray-800 pb-16">
        @forelse($popularGames as $game)
            <x-game-card :game="$game"/>
        @empty
            @foreach (range(1, 12) as $game)
                <div class="game-mt-8">
                    <div class="relative inline-block">
                        <div class="w-40 h-56 bg-gray-800">

                        </div>
                    </div>
                    <div class="text-transparent bg-gray-700 text-lg leading-tight rounded mt-4">Title Here</div>
                    <div class="text-transparent bg-gray-700 rounded mt-3 inline-block">Platforms Here</div>
                </div>
            @endforeach
        @endforelse
    </div>
    @push('scripts')
        @include('partials.rating', ['event' => 'gameWithRatingAdded'])
        {{--<script>
        window.livewire.on('gameWithRatingAdded', params => {
            console.log('A Game with Rating added ' + params.slug);
        })
        </script--}}>
    @endpush
</div>
