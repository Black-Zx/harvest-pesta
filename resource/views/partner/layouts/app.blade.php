<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partner.layouts.meta')
    @include('partner.layouts.styles')
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static @if(Route::currentRouteName() == 'partner.showLoginForm' || Route::currentRouteName() == 'partner.showForgotPasswordForm' || Route::currentRouteName() == 'password.reset')blank-page @endif" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    
    @if(Route::currentRouteName() != 'partner.showLoginForm' && Route::currentRouteName() != 'partner.showForgotPasswordForm' && Route::currentRouteName() != 'password.reset')
        @include('partner.layouts.header')
        @include('partner.layouts.menu')

        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            @yield('content')
        </div>

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        @include('partner.layouts.footer')
    @else
        @yield('content')
    @endif

    @include('partner.layouts.scripts')
</body>
</html>