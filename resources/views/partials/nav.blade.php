<header class="border-b border-gray-800">
    <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
        <div class="flex flex-col lg:flex-row items-center">
            <a href="/">
                <img src="../images/logo.png"
                     alt="{{ config('app.name') }}"
                     class="w-16 flex-none rounded-lg"/>
            </a>
            <ul class="flex ml-16 space-x-8 mt-6 lg:mt-0">
                <li><a href="" class="hover:text-gray-400">Games</a></li>
                <li><a href="" class="hover:text-gray-400">Reviews</a></li>
                <li><a href="" class="hover:text-gray-400">Coming Soon</a></li>
            </ul>
        </div>
        <div class="flex mt-6 lg:mt-0 items-center">
            <div class="relative">
                <input type="text" class="bg-gray-800 text-sm pl-8 rounded-full px-3 w-64 focus:outline-none focus:shadow-outline" placeholder="Search...">
                <div class="absolute top-0 flex items-center h-full ml-2">
                    <svg class="fill-current text-gray-400 w-4" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
                </div>
            </div>
            <div class="ml-6">
                <a href="#">
                    <img src="images/avatar.png" alt="Avatar" class="rounded-full w-8">
                </a>
            </div>
        </div>
    </nav>
</header>