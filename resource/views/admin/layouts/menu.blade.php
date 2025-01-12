<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header text-center">
        <img class="img-fluid matic-logo" src="{{ asset('/img/carsberg-logo.png') }}" alt="Carlsberg" />
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Check In List</span>
                </a>
            </li>
             {{-- <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.rsvp') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">RSVP</span>
                </a>
            </li> --}}
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.redemption') }}">
                    <i data-feather="check-square"></i>
                    <span class="menu-title text-truncate">Redemption list</span>
                </a>
            </li>
            
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('rsvp') }}">
                    <i data-feather="check-square"></i>
                    <span class="menu-title text-truncate">Register User</span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.engagement') }}">
                    <i data-feather="check-square"></i>
                    <span class="menu-title text-truncate">Engagement 1 list</span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.engagement2') }}">
                    <i data-feather="check-square"></i>
                    <span class="menu-title text-truncate">Engagement 2 list</span>
                </a>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->