<!DOCTYPE html>
<html lang="en">
<head>
    @include('Layouts.head')
</head>
<body>
    <header class="row">
        @include('Layouts.adminMenubar')
    </header>
    {{-- <div class="container ml-48 py-6 px-2 sm:px-4 lg:px-6 w-auto"> --}}
    <div class="px-3 py-3 lg:pl-[20rem] w-full overflow-auto xl:overflow-x-hidden">
        @yield('content')
    </div>

    <script type="text/javascript">    
        function openSidebar() {
            document.querySelector(".sidebar").classList.toggle("hidden");
        }
    </script>
</body>
</html>