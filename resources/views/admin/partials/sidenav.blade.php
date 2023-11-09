<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}"><span
                        class="brand-logo">
                        <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" width="150"
                            alt="logo"></span>
                    <!--<h2 class="brand-text">{{ $general->sitename }}</h2></a></li>-->
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if (\Route::current()->getName() == 'admin.dashboard') active @endif"><a class="d-flex align-items-center"
                    href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span
                        class="menu-title text-truncate" data-i18n="Dashboards">@lang('Dashboard')</span></a>

            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Finance &amp; Fund</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="dollar-sign"></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">@lang('Deposit')</span>
                </a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.gateway.automatic.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.gateway.automatic.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Automatic Gateways')</span></a>
                    </li>
                    {{-- <li class="@if (\Route::current()->getName() == 'admin.gateway.manual.index') active @endif"><a class="d-flex align-items-center" href="{{ route('admin.gateway.manual.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">@lang('Manual Gateways')</span></a>
                    </li> --}}
                    <li class="{{ Route::is('admin.banks.index') || Route::is('admin.banks.create') || Route::is('admin.banks.edit') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.banks.index') }}"><i
                                data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">@lang('Manage Banks')</span>
                        </a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.cash-deposit.index') active @endif">
                        <a class="d-flex align-items-center" href="{{ route('admin.cash-deposit.index') }}"><i
                                data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">@lang('Cash Deposits')</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('admin.deposits.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.deposits.index') }}"><i
                                data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">@lang('Deposits')</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#">
                    <i data-feather="shopping-cart"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Withdrawals')</span>
                    @if ($pending_withdraw_count)
                        <span class="badge badge-light-warning rounded-pill ms-auto me-2">New</span>
                    @endif
                </a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.withdraw.method.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.withdraw.method.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">@lang('Withdrawal Methods')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.withdraw.index') active @endif">
                        <a class="d-flex align-items-center" href="{{ route('admin.withdraw.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">@lang('Withdrawals')</span>
                            <span
                                class="badge badge-light-primary rounded-pill ms-auto me-2">{{ $withdraw_count }}</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="bar-chart-2"></i><span class="menu-title text-truncate"
                        data-i18n="Invest">@lang('Fixed Deposit')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.plan.timer') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.plan.timer') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Invest Timer">@lang('Manage Timer')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.plan.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.plan.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Invest New">@lang('Manage Plans')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.report.plan.invest.log') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.report.plan.invest.log') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Invest Log">@lang('Fixed Deposit Log')</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="percent"></i><span class="menu-title text-truncate" data-i18n="Invest">@lang('Manage Loan')</span></a>
                <ul class="menu-content">
                  <li class="@if(\Route::current()->getName() == 'admin.loan.index') active @endif"><a class="d-flex align-items-center" href="{{route('admin.loan.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="@lang('Manage Loan')">@lang('Manage Plans')</span></a>
                  </li>
                  <li class="@if(\Route::current()->getName() == 'admin.loan.request') active @endif"><a class="d-flex align-items-center" href="{{route('admin.loan.request')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="@lang('Loan Request')">@lang('Loan Request')</span></a>
                  </li>
                  <li class="@if(\Route::current()->getName() == 'admin.loan.active') active @endif"><a class="d-flex align-items-center" href="{{route('admin.loan.active')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="@lang('Active Loan')">@lang('Active Loan')</span></a>
                  </li>
                  <li class="@if(\Route::current()->getName() == 'admin.loan.closed') active @endif"><a class="d-flex align-items-center" href="{{route('admin.loan.closed')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="@lang('Closed Loan')">@lang('Closed Loan')</span></a>
                  </li>
                  <li class="@if(\Route::current()->getName() == 'admin.loan.declined') active @endif"><a class="d-flex align-items-center" href="{{route('admin.loan.declined')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="@lang('Declined Loan')">@lang('Declined Loan')</span></a>
                  </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shopping-bag"></i><span class="menu-title text-truncate"
                        data-i18n="Invest">@lang('Manage Savings')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.savings.savingPlan') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.savings.savingPlan') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate"
                                data-i18n="@lang('Target')">@lang('Saving Plans')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.savings.target') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.savings.target') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate"
                                data-i18n="@lang('Target')">@lang('Target Savings')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.savings.recurrent') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.savings.recurrent') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate"
                                data-i18n="@lang('Recurrent')">@lang('Recurrent Savings')</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="credit-card"></i><span class="menu-title text-truncate"
                        data-i18n="Invest">@lang('Manage Card')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.card.active') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.card.active') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate"
                                data-i18n="@lang('Active Card')">@lang('Valid Cards')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.card.inactive') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.card.inactive') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate"
                                data-i18n="@lang('Inactive Card')">@lang('Terminated Cards')</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="repeat"></i><span class="menu-title text-truncate"
                        data-i18n="Transfer">@lang('Fund Transfer')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.transfers.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.transfers.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate"
                                data-i18n="@lang('User Transfer')">@lang('User Transfer')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.transfer.other') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.transfer.other') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate"
                                data-i18n="@lang('Other Transfer')">@lang('Other Banks')</span></a>
                    </li>
                </ul>
            </li>

            @php
                $meta = json_decode($general->meta);
            @endphp

            @if ($meta->crypto ?? false)
                <li class=" navigation-header"><span data-i18n="Charts &amp; Maps">Crypto Wallet</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="pocket"></i><span class="menu-title text-truncate" data-i18n="Charts">Crypto Wallet</span><span class="badge badge-light-success rounded-pill ms-auto me-2">New</span></a>
                    <ul class="menu-content">
                        <li class="@if (\Route::current()->getName() == 'admin.coin.currency') active @endif"><a class="d-flex align-items-center" href="{{ route('admin.coin.currency') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Apex">Manage Currency</span></a>
                        </li>
                        <li class="@if (\Route::current()->getName() == 'admin.coin.wallet') active @endif"><a class="d-flex align-items-center" href="{{ route('admin.coin.wallet') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Apex">Manage Wallets</span></a>
                        </li>
                    </ul>
                </li>
              <!--  <li class="@if (\Route::current()->getName() == 'admin.coin.swap') active @endif nav-item"><a class="d-flex align-items-center" href="{{ route('admin.coin.swap') }}"><i data-feather="refresh-cw"></i><span class="menu-title text-truncate" data-i18n="Leaflet Maps">Coin Swap</span></a>
                </li> --!>
            @endif

            <!--##########USER MANAGER##########!-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">@lang('Manage Users')</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="users"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Manage Users')</span>

                </a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.users.all') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.all') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('All Users')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.active') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.active') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('Active Users')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.banned') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.banned') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('Banned Users')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.email.verified') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.email.verified') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('Email Verified')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.sms.verified') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.sms.verified') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('SMS Verified')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.email.unverified') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.email.unverified') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('Email Unverified')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.sms.unverified') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.sms.unverified') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('SMS Unverified')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.email.all') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.email.all') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('Email to All')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.with.balance') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.with.balance') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="User">@lang('Users With Balance')</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="camera"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Users Verification')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.users.kyc.settings') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.kyc.settings') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="KYC">@lang('KYC Settings')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.kyc.unverified') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.kyc.unverified') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="KYC">@lang('KYC Requests')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.kyc.verified') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.kyc.verified') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="KYC">@lang('KYC Verified')</span></a>
                    </li>

                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="life-buoy"></i><span class="menu-title text-truncate"
                        data-i18n="Ticket">@lang('Support Ticket')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.users.open.ticket') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.open.ticket') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Ticket">@lang('Open Ticket')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.replied.ticket') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.replied.ticket') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Ticket">@lang('Replied Ticket')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.users.closed.ticket') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.users.closed.ticket') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Ticket">@lang('Closed Ticket')</span></a>
                    </li>

                </ul>
            </li>

            <!--##########SETTINGS MANAGER##########!-->
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">@lang('System Settings')</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item @if (\Route::current()->getName() == 'admin.atms.index') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('admin.atms.index') }}"><i
                        data-feather="map"></i><span class="menu-item text-truncate"
                        data-i18n="ATM">@lang('Manage ATMs')</span></a>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="settings"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Settings')</span>
                </a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.setting.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.setting.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('General Setting')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.setting.logo.icon') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.setting.logo.icon') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Logo & Favicon')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.setting.dashboard.slide') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.setting.dashboard.slide') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Dashboard Slides')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.setting.dashboard.footer') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.setting.dashboard.footer') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Dashboard Footer')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.extensions.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.extensions.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Live Chat Setup')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.setting.cookie') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.setting.cookie') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Site Cookies')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.language.manage') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.language.manage') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Language')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.seo') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.seo') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('SEO Manager')</span></a>
                    <li class="@if (\Route::current()->getName() == 'admin.notify-settings.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.notify-settings.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Notify Settings')</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="mail"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Email Manager')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.email.template.global') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.email.template.global') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Global Template')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.email.template.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.email.template.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Email Templates')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.email.template.setting') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.email.template.setting') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Email Configure')</span></a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="tablet"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('SMS Manager')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'admin.sms.template.global') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.sms.template.global') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Global Template')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.sms.templates.setting') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.sms.templates.setting') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('SMS Gateways')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'admin.sms.template.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('admin.sms.template.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('SMS Template')</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="globe"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Manage Section')</span></a>
                <ul class="menu-content">
                    @php
                        $lastSegment = collect(request()->segments())->last();
                    @endphp
                    @foreach (getPageSections(true) as $k => $secs)
                        @if ($secs['builder'])
                            <li class="@if (\Route::current()->getName() == 'user.withdraws.index') active @endif"><a
                                    class="d-flex align-items-center"
                                    href="{{ route('admin.frontend.sections', $k) }}"><i
                                        data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="List">{{ __($secs['name']) }}</span></a>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </li>


            <li class=" navigation-header"><span data-i18n="Misc">Report</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'admin.report.transaction') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('admin.report.transaction') }}"><i
                        data-feather="printer"></i><span class="menu-title text-truncate"
                        data-i18n="Raise Support">@lang('Transaction Report')</span></a>
            </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'admin.report.login.history') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('admin.report.login.history') }}"><i
                        data-feather="life-buoy"></i><span class="menu-title text-truncate"
                        data-i18n="Raise Support">@lang('Login Report')</span></a>
            </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'admin.report.email.history') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('admin.report.email.history') }}"><i
                        data-feather="menu"></i><span class="menu-title text-truncate"
                        data-i18n="API Doc">@lang('Email Report')</span></a>

            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<!-- sidebar end -->
