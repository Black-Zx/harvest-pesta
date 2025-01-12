<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.meta')
    @include('layouts.styles')
</head>
<body class="responsive-bg">

    @yield('content')

    @include('layouts.footer')

    @include('layouts.scripts')
</body>
</html>