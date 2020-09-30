<div wire:init="loadMostAnticipated">
    <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Most Anticipated</h2>
    <div class="most-anticipated-container space-y-10 mt-8">
        @forelse ($mostAnticipated as $game)
            <x-game-card-small :game="$game"/>
        @empty
            @foreach (range(1, 3) as $game)
                <x-game-card-small-skeleton/>
            @endforeach
        @endforelse
    </div>
</div>
