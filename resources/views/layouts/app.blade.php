<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('layouts.header')
    </head>
    
    <body class="antialiased">
        <div id="app" class="container">
            @yield('content')
        </div>
    </body>

    <footer>
        @include('layouts.footer')
    </footer>
</html>
