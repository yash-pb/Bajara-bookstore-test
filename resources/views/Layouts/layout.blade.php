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
</body>
</html>