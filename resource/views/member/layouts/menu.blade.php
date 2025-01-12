<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header text-center">
        <img class="img-fluid matic-logo" src="{{ asset('/assets/img/carsberg-logo.png') }}" alt="carsberg" />        
    </div>
    <div class="main-menu-content">
         
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item @if (Route::currentRouteName()=='member.dashboard' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('member.dashboard') }}">
                    <i data-feather="layout"></i>
                    <span class="menu-title text-truncate">{{ __('messages.dashboard') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='member.showRegisterForm' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('member.showRegisterForm') }}">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate">{{ __('messages.register') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='member.showTeamPage' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('member.showTeamPage') }}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">{{ __('messages.team_overview') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='member.showWalletPurchaseForm'
                || Route::currentRouteName()=='member.showWalletTransferForm' ||
                Route::currentRouteName()=='member.showWalletConvertForm' ||
                Route::currentRouteName()=='member.showWalletWithdrawalForm' ) open @endif">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="credit-card"></i>
                    <span class="menu-title text-truncate">{{ __('messages.point_wallet') }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.showWalletPurchaseForm' ) active @endif" href="{{ route('member.showWalletPurchaseForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.purchase_insurance') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.showWalletTransferForm' ) active @endif" href="{{ route('member.showWalletTransferForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.transfer') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.showWalletConvertForm' ) active @endif" href="{{ route('member.showWalletConvertForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.convert') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.showWalletWithdrawalForm' ) active @endif" href="{{ route('member.showWalletWithdrawalForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.bonuses_withdrawal') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='member.showReloadForm' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('member.showReloadForm') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.guarantee_reload') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='member.reportBonuses' ||
                Route::currentRouteName()=='member.reportTransfer' || Route::currentRouteName()=='member.reportConvert'
                || Route::currentRouteName()=='member.reportPurchase' ||
                Route::currentRouteName()=='member.reportWithdrawal' || Route::currentRouteName()=='member.reportReload'
                ) open @endif">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="clipboard"></i>
                    <span class="menu-title text-truncate">{{ __('messages.report') }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.reportBonuses' ) active @endif" href="{{ route('member.reportBonuses') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.bonuses_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.reports.reportInsurancePoint' ) active @endif" href="{{ route('member.reports.reportInsurancePoint') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.insurance_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.reportTransfer' ) active @endif" href="{{ route('member.reportTransfer') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.transfer_point_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.reportConvert' ) active @endif" href="{{ route('member.reportConvert') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.convert_point_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.reportPurchase' ) active @endif" href="{{ route('member.reportPurchase') }}">
                            <i data-feather="circle"></i>
                            <span
                                class="menu-item text-truncate">{{ __('messages.purchase_insurance_point_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.reportWithdrawal' ) active @endif" href="{{ route('member.reportWithdrawal') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.withdrawal_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.reportReload' ) active @endif" href="{{ route('member.reportReload') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.guanrantee_reload_list') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='member.showProfileForm' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('member.showProfileForm') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.profile') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='member.showPasswordForm' ) open @endif">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate">{{ __('messages.setting') }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='member.showPasswordForm' ) active @endif" href="{{ route('member.showPasswordForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.change_login_password') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='member.tnc' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('member.tnc') }}">
                    <i data-feather="check-circle"></i>
                    <span class="menu-title text-truncate">{{ __('messages.terms_conditions') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
