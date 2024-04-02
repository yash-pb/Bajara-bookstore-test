<nav class="bg-gray-200">
    <div class="mx-auto container px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!--
              Icon when menu is closed.
  
              Menu open: "hidden", Menu closed: "block"
            -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!--
              Icon when menu is open.
  
              Menu open: "block", Menu closed: "hidden"
            -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <a href="{{ route('store.index') }}">
              <h1 class="text-2xl font-bold">Book Store</h1>
            </a>
          </div>
        </div>
        <div class="relative mx-auto text-gray-600 mr-5 md:block hidden">
            <form action="{{ route('store.index') }}" method="post">
              @csrf
              <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none" type="search" name="search" placeholder="Search" value="{{ $search ?? '' }}">
              <button type="submit" class="absolute right-4 top-3">
                <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                  viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                  width="512px" height="512px">
                  <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                </svg>
              </button>
            </form>
        </div>
        <div class="md:block hidden">
          @if (Auth::user())
            <a href="{{ route('user.favorite') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-10">Favorite Books</a>
            <a href="{{ route('user.edit.profile') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-10">Edit Profile</a>
            <a href="{{ route('user.logout') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Log out</a>
            {{-- <details class="dropdown">
              <summary class="m-1 btn">Profile</summary>
              <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                <li><a>Edit Profile</a></li>
                <li><a href="{{ route('user.logout') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Log out</a></li>
              </ul>
            </details> --}}
          @else  
            <a href="{{ route('user.login') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Log in</a>
          @endif
        </div>
      </div>
    </div>
  
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
    </div>
  </nav>
  