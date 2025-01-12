<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                            data-feather="menu"></i></a></li>
            </ul>
        </div>

        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(App::getLocale() == 'en')
                        <!-- <i class="flag-icon flag-icon-us"></i> -->
                        <span class="selected-language">EN</span>
                    @elseif(App::getLocale() == 'scn')
                        <span class="selected-language">简体中文</span>
                    @else
                        <!-- <i class="flag-icon flag-icon-cn"></i> -->
                        <span class="selected-language">繁體中文</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="{{ route('helpers.localization', 'en') }}" data-language="en">
                         EN
                    </a>
                    <a class="dropdown-item" href="{{ route('helpers.localization', 'cn') }}" data-language="cn">
                         繁體中文
                    </a>
                    <a class="dropdown-item" href="{{ route('helpers.localization', 'scn') }}" data-language="scn">
                        简体中文
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span
                            class="user-name font-weight-bolder">{{ Auth::user()->name }}</span><span
                            class="user-status">{{ __('messages.customer_service') }}</span></div><span
                        class="avatar"><img class="round" src="{{ asset('/assets/images/default.png') }}" alt="avatar"
                            height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('cs.logout') }}">
                        <i class="mr-50" data-feather="user"></i> {{ __('messages.logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->
