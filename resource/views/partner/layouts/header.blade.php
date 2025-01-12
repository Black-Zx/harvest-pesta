<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                            data-feather="menu"></i></a></li>
            </ul>
            <div>
                {{ __('messages.bonus_point') }}: {{ number_format(Auth::user()->totalBonus(), 2) }} |
                {{ __('messages.insurance_point') }}: {{ number_format(Auth::user()->totalInsurancePoint(), 2) }}
            </div>
        </div>

        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(App::getLocale() == 'en')
                        <i class="flag-icon flag-icon-us"></i>
                        <span class="selected-language">EN</span>
                    @else
                        <i class="flag-icon flag-icon-cn"></i>
                        <span class="selected-language">中文</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="{{ route('helpers.localization', 'en') }}" data-language="en">
                        <i class="flag-icon flag-icon-us"></i> EN
                    </a>
                    <a class="dropdown-item" href="{{ route('helpers.localization', 'cn') }}" data-language="en">
                        <i class="flag-icon flag-icon-cn"></i> 中文
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ Auth::user()->name }}</span>
                            <span class="user-status">
                                @if(Auth::user()->rank->name == 'Member')
                                    {{ __('messages.rank_member') }}
                                @elseif(Auth::user()->rank->name == 'Agent')
                                    {{ __('messages.rank_agent') }}
                                @elseif(Auth::user()->rank->name == 'Master Agent')
                                    {{ __('messages.rank_master_agent') }}
                                @elseif(Auth::user()->rank->name == 'Shareholder')
                                    {{ __('messages.rank_shareholder') }}
                                @elseif(Auth::user()->rank->name == 'Master Shareholder')
                                    {{ __('messages.rank_master_shareholder') }}
                                @elseif(Auth::user()->rank->name == 'Business Partner')
                                    {{ __('messages.rank_business_partner') }}
                                @endif
                            </span>
                        </div>
                        <span class="avatar"><img
                            class="round" src="{{ asset('/assets/images/default.png') }}" alt="avatar" height="40"
                            width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('partner.logout') }}">
                        <i class="mr-50" data-feather="user"></i> {{ __('messages.logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->
