<!DOCTYPE html>
<html lang="en">
<head>
    @include('Layouts.head')
</head>
<body>
    <header class="row">
        @include('Layouts.menubar')
    </header>
    @yield('content')

    <script type="text/javascript">
        function openSidebar() {
            document.querySelector("#mobile-menu").classList.toggle("hidden");
        }
    </script>
</body>
</html>