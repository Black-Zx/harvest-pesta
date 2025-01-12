<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('member.layouts.meta')
    @include('member.layouts.styles')
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static @if(Route::currentRouteName() == 'admin.showLoginForm')blank-page @endif" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    
    @if(Route::currentRouteName() != 'admin.showLoginForm')
        @include('admin.layouts.header')
        @include('admin.layouts.menu')

        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            @yield('content')
        </div>

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        @include('member.layouts.footer')
    @else
        @yield('content')
    @endif

    @include('member.layouts.scripts')
</body>
</html>