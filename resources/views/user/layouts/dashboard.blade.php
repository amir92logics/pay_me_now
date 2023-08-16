  <!DOCTYPE html>
  <html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->

  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
      @include('partials.seo')
      <title>{{ $general->sitename(__($pageTitle ?? env('APP_NAME'))) }}</title>

      @include('user.layouts.partials.styles')
  </head>

  <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static " data-open="click"
      data-menu="vertical-menu-modern" data-col="">

      @include('user.layouts.partials.topnav')
      @include('user.layouts.partials.sidebar')


      <div class="app-content content ">
          <div class="content-overlay"></div>
          <div class="header-navbar-shadow"></div>
          <div class="content-wrapper container-xxl p-0">
              <div class="content-header row">
              </div>


              <div class="d-flex card justify-content-start breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb ms-1">
                          <li class="breadcrumb-item"><a href="{{ route('user.home') }}">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? env('APP_NAME') }}
                          </li>
                      </ol>
                  </nav>
              </div>

              <div class="content-body">
                  @yield('content')
              </div>
          </div>
          @stack('modal')
          @include('user.layouts.partials.scripts')
  </body>

  </html>
