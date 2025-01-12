<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header text-center">
        <img class="img-fluid matic-logo" src="{{ asset('/app-assets/images/logo/logo.png') }}" alt="InsurBet Logo" />
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @if (Route::currentRouteName()=='cs.showBonusPoolList' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('cs.showBonusPoolList') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.winning_pool') }}</span>
                </a>
            </li>
            {{-- <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('cs.dashboard') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li> --}}
            <li class=" nav-item @if (Route::currentRouteName()=='cs.approval.showMembership' ||
                Route::currentRouteName()=='cs.approval.showInsurance' ||
                Route::currentRouteName()=='cs.approval.showWithdrawal' ||
                Route::currentRouteName()=='cs.approval.showGuarantee' ) open @endif">
                <a class="d-flex align-items-center" href="#') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.approval_list') }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.approval.showMembership' ) active @endif" href="{{ route('cs.approval.showMembership') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.membership') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.approval.showInsurance' ) active @endif" href="{{ route('cs.approval.showInsurance') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.insurance') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.approval.showWithdrawal' ) active @endif" href="{{ route('cs.approval.showWithdrawal') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.withdrawal') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.approval.showGuarantee' ) active @endif" href="{{ route('cs.approval.showGuarantee') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.guarantee') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.approval.showApprovalList' ) active @endif" href="{{ route('cs.approval.showApprovalList') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.update_member_rank') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='cs.reports.membersAndDownlinesReport' ||
                Route::currentRouteName()=='cs.reports.insurancePointReport' ||
                Route::currentRouteName()=='cs.reports.bonusReport' ||
                Route::currentRouteName()=='cs.reports.membersWithdrawReport' ||
                Route::currentRouteName()=='cs.reports.guaranteeClaimReport' ||
                Route::currentRouteName()=='cs.reports.protectionReport' ) open @endif">
                <a class="d-flex align-items-center" href="#') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.reports') }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.reports.membersAndDownlinesReport' ) active @endif"
                            href="{{ route('cs.reports.membersAndDownlinesReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.member_downline') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.reports.insurancePointReport' ) active @endif" href="{{ route('cs.reports.insurancePointReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.insurance_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.reports.bonusReport' ) active @endif" href="{{ route('cs.reports.bonusReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.bonus_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.reports.membersWithdrawReport' ) active @endif" href="{{ route('cs.reports.membersWithdrawReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.member_withdraw_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.reports.guaranteeClaimReport' ) active @endif" href="{{ route('cs.reports.guaranteeClaimReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.guarantee_claim_report') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.reports.protectionReport' ) active @endif" href="{{ route('cs.reports.protectionReport') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.protection_report') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='cs.showMemberList' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('cs.showMemberList') }}">
                    <i data-feather="copy"></i>
                    <span class="menu-title text-truncate">{{ __('messages.member_list') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='cs.showBannerForm' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('cs.showBannerForm') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.pop_up_banner') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='cs.showBankForm' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('cs.showBankForm') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.bank_details') }}</span>
                </a>
            </li>
            <li class=" nav-item @if (Route::currentRouteName()=='cs.history.showMembership' ||
                Route::currentRouteName()=='cs.history.showInsurance' ||
                Route::currentRouteName()=='cs.history.showWithdrawal' ||
                Route::currentRouteName()=='cs.history.showGuarantee' ) open @endif">
                <a class="d-flex align-items-center" href="#') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">{{ __('messages.history') }}</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.history.showMembership' ) active @endif" href="{{ route('cs.history.showMembership') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.membership') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.history.showInsurance' ) active @endif" href="{{ route('cs.history.showInsurance') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.insurance') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.history.showWithdrawal' ) active @endif" href="{{ route('cs.history.showWithdrawal') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.withdrawal') }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center @if (Route::currentRouteName()=='cs.history.showGuarantee' ) active @endif" href="{{ route('cs.history.showGuarantee') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('messages.guarantee') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li class=" nav-item @if (Route::currentRouteName()=='cs.showNotification' ) active @endif">
                <a class="d-flex align-items-center" href="{{ route('cs.showNotification') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Notification</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
