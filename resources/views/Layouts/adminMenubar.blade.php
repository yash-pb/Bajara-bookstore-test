<nav class="bg-gray-200 lg:ml-[18rem] w-auto">
    <div class="mx-auto container px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center lg:items-stretch lg:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('admin.livewire.dashboard') }}">
                        <h1 class="text-2xl font-bold">Admin Panel</h1>
                    </a>
                </div>
            </div>
            <div class="">
                @if (Auth::user())
                    <a href="{{ route('user.logout') }}" class="font-medium text-blue-600 hover:underline">Log out</a>
                @else
                    <a href="{{ route('user.login') }}" class="font-medium text-blue-600 hover:underline">Log in</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
    </div>
</nav>

<span class="absolute text-white text-2xl top-4 left-4 cursor-pointer" onclick="openSidebar()">
    <i class="fa-solid fa-bars px-2 bg-gray-900 rounded-md p-1"></i>
</span>
<div
    class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900 hidden lg:block z-10">
    <div class="text-gray-100 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
            <a href="{{ route('admin.livewire.dashboard') }}">
                <h1 class="font-bold text-gray-200 ml-3 w-full">Admin Panel</h1>
            </a>
            <span class="bi bi-x cursor-pointer ml-28 lg:hidden" onclick="openSidebar()">&#10005;</span>
        </div>
        <div class="my-2 bg-gray-600 h-[1px]"></div>
    </div>
    {{-- {{ dd(request()) }} --}}
    <a href="{{ route('admin.livewire.dashboard') }}">
        <div
            class="{{ request()->is('admin/livewire/dashboard') ? 'bg-blue-600' : '' }} p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            <i class="bi bi-house-door-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-bold">Dashboard</span>
        </div>
    </a>
    {{-- <a href="{{ route('admin.livewire.books.list') }}">
        <div
            class="{{ request()->is('admin/livewire/books') ? 'bg-blue-600' : '' }} p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            <i class="bi bi-house-door-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-bold">Books</span>
        </div>
    </a> --}}
    <a href="{{ route('admin.livewire.books.list') }}">
        <div
            class="{{ request()->is('admin/livewire/books') ? 'bg-blue-600' : '' }} p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            <i class="bi bi-house-door-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-bold">Books</span>
        </div>
    </a>
</div>
