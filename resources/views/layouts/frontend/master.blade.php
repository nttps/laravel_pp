<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.frontend.includes.head')
</head>
<body>
    <div class="container-fluid">
        @yield('content')
    </div>
    @include('layouts.frontend.includes.footer')
    @include('layouts.frontend.includes.script')
</body>
</html>