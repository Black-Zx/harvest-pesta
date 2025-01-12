<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('member.layouts.meta')
    @include('member.layouts.styles')
</head>
<body class="antialiased">

    @yield('content')

    @include('member.layouts.scripts')
</body>
</html>