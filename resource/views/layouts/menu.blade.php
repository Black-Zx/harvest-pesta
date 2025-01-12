<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('member.dashboard') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Dashboard</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('member.showRegisterForm') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Register</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('member.showTeamPage') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Team Overview</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="copy"></i>
                    <span class="menu-title text-truncate">Point Wallet</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.showWalletPurchaseForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Purchase Insurance Point</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.showWalletTransferForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Transfer</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.showWalletConvertForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Convert</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.showWalletWithdrawalForm') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Bonuses Withdrawal</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('member.showReloadForm') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Guarantee Reload</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="copy"></i>
                    <span class="menu-title text-truncate">Report</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.reportWallet') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Wallet Transaction List</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.reportBonuses') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Bonuses Report</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.reportTransfer') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Transfer Point Report</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.reportPurchase') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Purchase Insurance Point Report</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.reportWithdrawal') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Withdrawal Report</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.reportReload') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Guarantee Reload List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('member.profile') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Profile</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="copy"></i>
                    <span class="menu-title text-truncate">Setting</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="d-flex align-items-center" href="{{ route('member.setting') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Change Login Password</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('member.tnc') }}">
                    <i data-feather="mail"></i>
                    <span class="menu-title text-truncate">Terms & Conditions</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->