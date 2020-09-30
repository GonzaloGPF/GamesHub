<div wire:init="loadComingSoon">
    <h2 class="text-blue-500 uppercase tracking-wide font-semibold mt-12">Coming Soon</h2>
    <div class="most-anticipated-container space-y-10 mt-8">
        @forelse ($comingSoon as $game)
            <x-game-card-small :game="$game"/>
        @empty
            @foreach (range(1, 3) as $game)
                <x-game-card-small-skeleton/>
            @endforeach
        @endforelse
    </div>
</div>
