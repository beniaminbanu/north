@include('layouts.includes.scripts')
<!DOCTYPE html>
<html lang="en">

    @include('layouts.components.head')

<body>

    @include('layouts.components.header')
    @include('layouts.components.buttonup')
    @include('layouts.svg')
    @yield('content')

    @include('layouts.components.footer')
    <div id="scripts">
        @stack('scripts')
    </div>
</body>
</html>
