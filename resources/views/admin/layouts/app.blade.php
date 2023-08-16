@extends('admin.layouts.master')

@section('content')
    @include('admin.partials.sidenav')
    @include('admin.partials.topnav')

    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            @if ($pageTitle ?? false)
                                <h2 class="content-header-title float-start mb-0">{{ __($pageTitle) }}</h2>
                            @endif
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a>
                                    </li>
                                    @if ($pageTitle ?? false)
                                        <li class="breadcrumb-item active">{{ __($pageTitle) }}</li>
                                    @endif
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        @stack('breadcrumb-top-right')
                        @stack('breadcrumb-plugins')
                    </div>
                </div>
            </div>
            @yield('panel')
        @endsection
