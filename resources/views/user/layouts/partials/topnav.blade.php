<!-- BEGIN: Header-->
<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon text-white"
                            data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('user.support') }}"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon text-white"
                            data-feather="mail"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('user.ticket.open') }}"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create Ticket"><i
                            class="ficon text-white" data-feather="message-square"></i></a></li>
            </ul>

        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i
                        class="flag-icon @if (session('lang') == 'en') flag-icon-us @else flag-icon-{{ session('lang') }} @endif"></i><span
                        class="selected-language text-white">{{ session('lang') }}</span></a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                    @foreach ($language as $item)
                        <a class="dropdown-item" href="{{ route('lang', $item->code) }}"
                            data-language="{{ $item->code }}"><i
                                class="flag-icon @if ($item->code == 'en') flag-icon-us @else flag-icon-{{ $item->code }} @endif"></i>
                            {{ __($item->name) }}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon text-white"
                        data-feather="moon"></i></a></li>
                <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#"
                    data-bs-toggle="dropdown"><i class=" text-white ficon" data-feather="bell"></i>
                    @if ($userNotifications->count() > 0)
                        <span class="badge rounded-pill bg-danger badge-up">{{ $userNotifications->count() }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">Notifications</h4>
                            @if ($userNotifications->count() > 0)
                                <div class="badge rounded-pill bg-danger">{{ $userNotifications->count() }}
                                    New</div>
                            @endif

                        </div>
                    </li>
                    @foreach ($userNotifications as $notification)
                        <li class="scrollable-container media-list"><a class="d-flex"  href="{{ route('user.notification.read', $notification->id) }}">

                            <div class="list-item d-flex align-items-start">
                                <div class="me-1">
                                    <div class="avatar">
                                        <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . @$notification->user->image, imagePath()['profile']['user']['size']) }}"
                                            alt="avatar" width="32" height="32">
                                    </div>
                                </div>
                                <div class="list-item-body flex-grow-1">
                                    <p class="media-heading">
                                        <span class="fw-bolder">{{ __($notification->title) }}</span>
                                    </p>
                                    <small class="notification-text">{{ $notification->created_at->diffForHumans() }}.</small>
                                </div>
                            </div>
                            </a><a class="d-flex" href="{{ route('user.notification.read', $notification->id) }}">
                        </li>
                    @endforeach
                </ul>
            </li>
            <!-- <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon text-white"
                        data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore {{ $general->sitename }}..."
                        tabindex="-1" data-search="search">
                    <div class="search-input-close  text-white"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li> -->


            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span
                            class="user-name fw-bolder text-white">{{ Auth::user()->username }}</span><span
                            class="user-status text-white">Account</span></div><span class="avatar"><img class="round"
                            src="{{ @getImage(imagePath()['profile']['user']['path'] . '/' . $user->image, imagePath()['profile']['user']['size']) }}"
                            alt="avatar" height="40" width="40"><span
                            class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a class="dropdown-item"
                        href="{{ route('user.profile.setting') }}"><i class="me-50" data-feather="user"></i>
                        @lang('Profile')</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item"
                        href="{{  route('user.kyc') }}"><i
                        data-feather="camera"></i>
                        @lang('Varification')</a>
                        <a class="dropdown-item"
                        href="{{ route('user.twofactor') }}"><i
                        data-feather="shield"></i>
                        @lang('Google
                        2FA')</a><a class="dropdown-item"
                        href="{{ route('user.change.password') }}"><i class="me-50" data-feather="settings"></i>
                        @lang('Security')</a>
                        <a class="dropdown-item" href="{{ route('user.logout') }}"><i
                            class="me-50" data-feather="power"></i>
                        @lang('Logout')</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
