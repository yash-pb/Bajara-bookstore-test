<nav class="bg-gray-200">
    <div class="mx-auto container px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center lg:hidden">
                <i class="fa-solid fa-bars relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" onclick="openSidebar()"></i>
            </div>
            <div class="flex flex-1 items-center justify-center lg:items-stretch lg:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('store.index') }}">
                        <h1 class="text-2xl font-bold">Book Store</h1>
                    </a>
                </div>
            </div>
            <div class="relative mx-auto text-gray-600 mr-5 md:block hidden">
                <form action="{{ route('store.index') }}" method="post">
                    @csrf
                    <input disabled="disabled"
                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                        type="search" name="search" placeholder="Search" value="{{ $search ?? '' }}">
                    <button disabled="disabled" type="submit" class="absolute right-4 top-3">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                            xml:space="preserve" width="512px" height="512px">
                            <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="lg:block hidden">
                @if (Auth::user())
                    <a href="{{ route('user.favorite') }}"
                        class="font-medium text-blue-600 hover:underline mr-10">Favorite Books</a>
                    <a href="{{ route('user.edit.profile') }}"
                        class="font-medium text-blue-600 hover:underline mr-10">Edit Profile</a>
                    <a href="{{ route('user.logout') }}"
                        class="font-medium text-blue-600 hover:underline">Log out</a>
                @else
                    <a href="{{ route('user.login') }}"
                        class="font-medium text-blue-600 hover:underline">Log in</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div id="mobile-menu" class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900 hidden z-10">
        <div class="text-gray-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center">
                <a href="{{ route('store.index') }}">
                    <h1 class="font-bold text-gray-200 ml-3">Book Store</h1>
                </a>
                <span class="bi bi-x cursor-pointer ml-28 lg:hidden" onclick="openSidebar()">&#10005;</span>
            </div>
            <div class="mt-2 bg-gray-600 h-[1px]"></div>
        </div>

        @if (Auth::user())
          <a href="{{ route('user.favorite') }}" class="no-underline font-medium text-blue-600">
              <div class="flex p-2 items-center rounded-md duration-300 cursor-pointer hover:bg-blue-600 text-white">
                  <span class="text-[15px] ml-4 text-gray-200 font-bold">Favorite Books</span>
              </div>
          </a>

          <a href="{{ route('user.edit.profile') }}" class="no-underline font-medium text-blue-600">
              <div class="flex p-2 items-center rounded-md duration-300 cursor-pointer hover:bg-blue-600 text-white">
                  <span class="text-[15px] ml-4 text-gray-200 font-bold">Edit Profile</span>
              </div>
          </a>

          <a href="{{ route('user.logout') }}" class="no-underline font-medium text-blue-600">
              <div class="flex p-2 items-center rounded-md duration-300 cursor-pointer hover:bg-blue-600 text-white">
                  <span class="text-[15px] ml-4 text-gray-200 font-bold">Log out</span>
              </div>
          </a>
        @else  
          <a href="{{ route('user.login') }}" class="no-underline font-medium text-blue-600">
            <div class="flex p-2 items-center rounded-md duration-300 cursor-pointer hover:bg-blue-600 text-white">
                <span class="text-[15px] ml-4 text-gray-200 font-bold">Log in</span>
            </div>
          </a>
        @endif

    </div>
    {{-- </a> --}}
    </div>
</nav>
