
<!DOCTYPE html>
<html>
    <head>
        @vite('resources/css/app.css')
        @yield('css')
        
        @include('layouts.include.navbar')
    </head>
    <body>
        <div id="app">
            @yield('content')

            {{-- @include('layouts.include.footer') --}}

        </div>

    </body>
</html>