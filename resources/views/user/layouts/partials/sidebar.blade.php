@php
    $meta = json_decode($general->meta);
@endphp
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('user.home') }}"><span class="brand-logo">
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
            <li class="@if (\Route::current()->getName() == 'user.home') active @endif"><a class="d-flex align-items-center"
                    href="{{ route('user.home') }}"><i data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">@lang('Dashboard')</span></a>

            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Finance &amp; Fund</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="dollar-sign"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Deposit')</span></a>
                <ul class="menu-content">
                    <li class="{{ Route::is('user.deposits.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('user.deposits.create') }}"><i
                                data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">@lang('Make Deposit')</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('user.deposits.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('user.deposits.index') }}"><i
                                data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">@lang('Deposits')</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shopping-cart"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Withdraw')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'user.withdraw-methods.index') active @endif">
                        <a class="d-flex align-items-center" href="{{ route('user.withdraw-methods.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">@lang('Make Withdraw')</span>
                        </a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'user.withdraws.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('user.withdraws.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Preview">@lang('Withdrawal Log')</span></a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="percent"></i><span class="menu-title text-truncate" data-i18n="Invoice">@lang('Loan')</span></a>
                <ul class="menu-content">
                  <li class="@if(\Route::current()->getName() == 'user.loan.request') active @endif"><a class="d-flex align-items-center" href="{{ route('user.loan.request') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">@lang('Request Loan')</span></a>
                  </li>
                  <li class="@if(\Route::current()->getName() == 'user.myloan') active @endif"><a class="d-flex align-items-center" href="{{ route('user.myloan') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">@lang('Loan History')</span></a>
                  </li>
                  <li class="@if(\Route::current()->getName() == 'user.totalloan') active @endif"><a class="d-flex align-items-center" href="{{ route('user.totalloan') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">@lang('Total Loan')</span></a>
                  </li>
                </ul>
            </li>

            @if ($meta->savings ?? false)
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                data-feather="shopping-bag"></i><span class="menu-title text-truncate"
                data-i18n="Invoice">@lang('Savings')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'user.savings.request') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('user.savings.request') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('New Savings')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'user.mysavings') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('user.mysavings') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Preview">@lang('My Savings')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'user.savingbalance') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('user.savingbalance') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Preview">@lang('History')</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="shopping-bag"></i><span class="menu-title text-truncate"
                        data-i18n="Invoice">@lang('Liquid Cash Account')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'user.subsaving.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('user.subsaving.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="List">@lang('Other Accounts')</span></a>
                    </li>
                    <li class="@if (\Route::current()->getName() == 'user.subsaving.create') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('user.subsaving.create') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Preview">@lang('New LC Account')</span></a>
                    </li>

                </ul>
            </li>
            @endif

            @if ($meta->card ?? false)
            <li class="@if (\Route::current()->getName() == 'user.vcard') active @endif nav-item"><a
                    class="d-flex align-items-center" href="{{ route('user.vcard') }}"><i
                        data-feather="credit-card"></i><span class="menu-title text-truncate"
                        data-i18n="Credit Card">@lang('Virtual Card')</span></a>
            </li>
            @endif
            
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="repeat"></i><span class="menu-title text-truncate"
                        data-i18n="repeat">@lang('Fund Transfer')</span></a>
                <ul class="menu-content">
                    <li class="@if (\Route::current()->getName() == 'user.transfers.index') active @endif"><a class="d-flex align-items-center"
                            href="{{ route('user.transfers.index') }}"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Transfer">User to User</span></a>
                    </li>
                    <!-- @if ($meta->other_bank ?? false)
                    <li class="@if (\Route::current()->getName() == 'user.othertransfer') active @endif"><a class="d-flex align-items-center" href="{{ route('user.othertransfer') }}"><i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="Interl">Other Bank Transfer</span></a>
                    </li>
                    @endif -->
                </ul>
            </li>


            @if ($meta->crypto ?? false)
            <li class=" navigation-header"><span data-i18n="Charts &amp; Maps">Crypto Wallet</span><i
                    data-feather="more-horizontal"></i>
            </li>
            @php $cryptos = App\Models\Currency::whereStatus(1)->get(); @endphp
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                        data-feather="pocket"></i><span class="menu-title text-truncate" data-i18n="Charts">Crypto
                        Wallet</span><span class="badge badge-light-success rounded-pill ms-auto me-2">New</span></a>
                <ul class="menu-content">
                    @foreach ($cryptos as $data)
                        <li><a class="d-flex align-items-center" href="{{ route('user.wallet', $data->symbol) }}"><i
                                    data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Apex">{{ $data->name }}</span></a>
                        </li>
                    @endforeach
                </ul>
            </li>
            @endif

            <li class="@if (\Route::current()->getName() == 'user.swapcoin') active @endif nav-item"><a
                    class="d-flex align-items-center" href="{{ route('user.swapcoin') }}"><i
                        data-feather="refresh-cw"></i><span class="menu-title text-truncate"
                        data-i18n="Leaflet Maps">Coin Swap</span></a>
            </li>

            <!-- <li class=" navigation-header"><span data-i18n="User Interface">User Settings</span><i
                    data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'user.profile.setting') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('user.profile.setting') }}"><i
                        data-feather="user"></i><span class="menu-title text-truncate"
                        data-i18n="User">Profile</span></a>
            </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'user.change.password') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('user.change.password') }}"><i
                        data-feather="lock"></i><span class="menu-title text-truncate"
                        data-i18n="lock">Password</span></a>
            </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'user.kyc') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('user.kyc') }}"><i
                        data-feather="camera"></i><span class="menu-title text-truncate"
                        data-i18n="lock">Verification</span></a>
            </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'user.twofactor') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('user.twofactor') }}"><i
                        data-feather="shield"></i><span class="menu-title text-truncate" data-i18n="Shield">Google
                        2FA</span></a>

            </li> -->
            <li class=" navigation-header"><span data-i18n="Misc">Misc</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'user.atms.index') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('user.atms.index') }}"><i
                        data-feather="map"></i><span class="menu-title text-truncate"
                        data-i18n="ATM Location">ATMs</span></a> </li>

            <li class=" nav-item @if (\Route::current()->getName() == 'user.trx.log') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('user.trx.log') }}"><i
                        data-feather="printer"></i><span class="menu-title text-truncate"
                        data-i18n="Raise Support">Print Report</span></a> </li>
            <li class=" nav-item @if (\Route::current()->getName() == 'user.support') active @endif"><a
                    class="d-flex align-items-center" href="{{ route('user.support') }}"><i
                        data-feather="life-buoy"></i><span class="menu-title text-truncate"
                        data-i18n="Raise Support">Support Tickets</span></a> </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('user.logout') }}"><i
                        data-feather="power"></i><span class="menu-title text-truncate"
                        data-i18n="Logout">Logout</span></a> </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
