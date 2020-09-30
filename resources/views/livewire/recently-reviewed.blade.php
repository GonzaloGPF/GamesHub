<div wire:init="loadRecentlyReviewed">
    <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Recently Reviewed</h2>
    <div class="recently-viewed-container space-y-12 mt-8">
        @forelse ($recentlyReviewed as $game)
            <div class="bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
                <div class="relative flex-none">
                    <a href="#">
                        <img src="{{ $game['cover_url'] }}"
                             alt="{{ $game['name'] }}"
                             class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    @if (isset($game['rating']))
                        <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full"
                             style="right: -20px; bottom: -20px">
                            <div class="font-semibold text-xs flex justify-center items-center h-full">
                                {{ $game['rating'] }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="ml-12">
                    <a href="#" class="block text-lg font-semitbold leading-tight hover:text-gray-400 mt-4">
                        {{ $game['name'] }}
                    </a>
                    <div class="text-gray-400 mt-1">
                        {{ $game['platforms'] }}
                    </div>
                    <p class="mt-6 text-gray-400 hidden lg:block">
                        {{ $game['summary'] }}
                    </p>
                </div>
            </div>
        @empty
            @foreach (range(1, 3) as $game)
                <div class="bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
                    <div class="flex flex-none">
                        <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-56"></div>
                    </div>
                    <div class="ml-12">
                        <div class="inline-block text-transparent bg-gray-700 text-lg leading-tight mt-4">Title Here</div>
                        <div class="mt-8 space-y-4 hidden lg:block">
                            <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                            <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                            <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforelse
    </div>
</div>