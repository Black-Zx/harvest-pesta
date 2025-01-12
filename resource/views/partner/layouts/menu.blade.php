<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header text-center">
        <img class="img-fluid matic-logo" src="{{ asset('/app-assets/images/logo/logo.png') }}" alt="InsurBet Logo" />
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item @if (Route::currentRouteName()=='partner.showTeamPage' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('partner.showTeamPage') }}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">{{ __('messages.team_overview') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='partner.reports.membersAndDownlinesReport' ||
                Route::currentRouteName()=='partner.reports.insurancePointReport' ||
                Route::currentRouteName()=='partner.reports.bonusReport' ||
                Route::currentRouteName()=='partner.reports.membersWithdrawReport' ||
                Route::currentRouteName()=='partner.reports.guaranteeClaimReport' ||
                Route::currentRouteName()=='partner.reports.protectionReport' ) open @endif">
                <a class="d-flex align-items-center" href="#') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.reports') }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='partner.reports.membersAndDownlinesReport' ) active @endif"
                            href="{{ route('partner.reports.membersAndDownlinesReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.member_downline') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='partner.reports.insurancePointReport' ) active @endif" href="{{ route('partner.reports.insurancePointReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.insurance_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='partner.reports.bonusReport' ) active @endif" href="{{ route('partner.reports.bonusReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.bonus_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='partner.reports.membersWithdrawReport' ) active @endif" href="{{ route('partner.reports.membersWithdrawReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.member_withdraw_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='partner.reports.guaranteeClaimReport' ) active @endif" href="{{ route('partner.reports.guaranteeClaimReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.guarantee_claim_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='partner.reports.protectionReport' ) active @endif" href="{{ route('partner.reports.protectionReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.protection_report') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
