<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('member.layouts.meta')
    @include('member.layouts.styles')
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static @if(Route::currentRouteName() == 'cs.showLoginForm')blank-page @endif" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    
    @if(Route::currentRouteName() != 'cs.showLoginForm')
        @include('cs.layouts.header')
        @include('cs.layouts.menu')

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
    <script>

        notification();
        setInterval(function () {
            notification();
        }, 60000);

        function notification() {
            $.ajax({
                url: "{{ route('cs.getNotification') }}",
            }).done(function(response) {

                if(response.status) {
                    let notifications  = response.notification;

                    notifications.forEach(function(item) {

                        let html = '<div class="toast-' + item.id + ' toast toast-autohide toast-stacked hide" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">'
                            + '<div class="toast-header">'
                            + '<strong class="mr-auto">' + item.type + '</strong>'
                            + '<small class="text-muted">' + item.created_at + '</small>'
                            + '<button type="button" class="ml-1 close" data-dismiss="toast" aria-label="Close">'
                            + '<span aria-hidden="true">&times;</span>'
                            + '</button>'
                            + '</div>'
                            + '<a href="' + item.url + '" target="_blank">'
                            + '<div class="toast-body">' + item.message +'</div>'
                            + '</a>'
                            + '</div>'
                        

                        $('#notification-body').append(html);

                        $('.toast-' + item.id).toast('show');

                        let audio = new Audio("{{ asset('/assets/mp3/notification.mp3') }}");
                        audio.play();
                    });

                }
            });
        }
    </script>
</body>
</html>