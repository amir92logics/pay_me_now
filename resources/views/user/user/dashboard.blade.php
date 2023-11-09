@extends($activeTemplate . 'layouts.dashboard')
@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce" class="d-none d-sm-block">
    <div class="row match-height">
        <!-- Medal Card -->

        @if ($general->news)
        <section id="alerts-with-icons">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-text">Update & News</h4>
                    <div class="alert alert-primary alert-dismissible fade show p-1" role="alert">
                        <i data-feather="star" class="me-50"></i>
                        <span> {{ $general->news }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Greetings Card starts -->
      
    <!-- Greetings Card ends -->
    {{-- <div class="row"> --}}

    <div class=" col-md-4">
        <div class="card card-primary">
            <div class="card-body">
                {{-- <div class="d-flex justify-content-between">
                    <h6> <b>@lang('Premier Account Balance')</b></h6>
                    <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                            data-bs-placement="top" data-bs-container="body" title="asdasd"
                            data-bs-content="{{ Auth::user()->account_number }}" data-bs-original-title="Account No."
                            aria-describedby="popover343370">
                            <i data-feather='eye'></i>
                        </button>
                    </div>
                    <h3 class="pt-50 d-flex justify-content-between">
                        <a href="#"> {{ $general->cur_sym }} {{ showAmount($user->balance) }}</a>
                        <a href="{{ route('user.deposits.index') }}"
                        class="btn btn-primary">{{ __('Deposit') }}</a>
                    </h3> --}}
                <h5> <b>@lang('Premier Account Balance')</b> <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                    data-bs-placement="top" data-bs-container="body" title="asdasd"
                    data-bs-content="{{ Auth::user()->account_number }}" data-bs-original-title="Account No."
                    aria-describedby="popover343370">
                    <i data-feather='eye'></i>
                </button></h5>
                <h2 class="mb-75 mt-2 pt-50">
                    <a href="#"> {{ $general->cur_sym }} {{ showAmount($user->balance) }}</a>
                </h2>
                {{-- @if ($pendingDeposit == 0)
                <div class="row mt-2">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                            data-bs-placement="top" data-bs-container="body" title=""
                            data-bs-content="{{ Auth::user()->account_number }}" data-bs-original-title="Account No."
                            aria-describedby="popover343370">
                            <i data-feather='eye'></i>
                        </button>
                    </div>
                    <div class="col-12 text-end">
                        <a href="{{ route('user.deposits.index') }}"
                            class="btn btn-primary text-end mt-1">{{ __('Deposit') }}</a>
                    </div>
                </div>
                @endif --}}


                @if ($pendingDeposit > 0)
                <div class="row mt-4">
                    <div class="col-12">
                        
                        <h5> <b>@lang('Pending Deposit')</b></h5>
                        <h3 class="mb-75 mt-2 pt-30">
                            <a href="#"> {{ $general->cur_sym }} {{ showAmount($pendingDeposit) }}</a>
                        </h3>
                        
                    </div>
                    
                </div>
                @endif
            <div class="row">

                <div class="col-6 col-md-12 col-lg-6">
                    {{-- <div class="col-12">
                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="popover"
                        data-bs-placement="top" data-bs-container="body" title=""
                        data-bs-content="{{ Auth::user()->account_number }}"
                        data-bs-original-title="Account No." aria-describedby="popover343370">
                        <i data-feather='eye'></i>
                        </button>
                    </div> --}}
                    <div class="col-12">
                       <a href="{{ route('user.withdraw-methods.index') }}"
                       class="btn btn-primary mt-1">{{ __('Withdraw') }}</a>
                    </div>
                </div>
                <div class="col-6 text-end">
                    {{-- <div class="col-12 ">
                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="popover"
                        data-bs-placement="top" data-bs-container="body" title=""
                        data-bs-content="{{ Auth::user()->account_number }}"
                        data-bs-original-title="Account No." aria-describedby="popover343370">
                        <i data-feather='eye'></i>
                        </button>
                    </div> --}}
                <div class="col-12">
                    <a href="{{ route('user.deposits.index') }}"
                    class="btn btn-primary mt-1">{{ __('Deposit') }}</a>
                </div>
            </div>
        </div>
            </div>
         </div>
    </div>

    <div class=" col-md-4">
    @if ($subAccounts > 0 && $SubSavingAccountBalance > 0)

        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 ">
                        <h5> <b>@lang('Saving Account')</b></h5>

                        <h3 class="mb-75 mt-2 pt-50">
                            <a href="{{ route('user.mysavings') }}"> {{ $general->cur_sym }}
                                {{ showAmount($saved) }}</a>
                        </h3>
                    </div>

                    <div class="col-6">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-container="body" title=""
                                aria-describedby="popover343370">
                                <i data-feather='eye'></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-10 ">
                        <h5> <b>@lang('Liquid Cash Account')</b></h5>

                        <h3 class="mb-75 mt-2 pt-50">
                            <a href="{{ route('user.subsaving.index') }}"> {{ $general->cur_sym }}
                                {{ showAmount($SubSavingAccountBalance) }}</a>
                        </h3>
                    </div>

                    <div class="col-2">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-container="body" title=""
                                aria-describedby="popover343370">
                                <i data-feather='eye'></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endif
      @if ($subAccounts > 0 && $SubSavingAccountBalance == 0)

                <div class="row bg-white p-1">
                    <div class="col-6 ">
                        <h5> <b>@lang('Saving Account')</b></h5>

                        <h3 class="mb-75 mt-2 pt-50">
                            <a href="{{ route('user.mysavings') }}"> {{ $general->cur_sym }}
                                {{ showAmount($saved) }}</a>
                        </h3>
                    </div>

                    <div class="col-6">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-container="body" title=""
                                aria-describedby="popover343370">
                                <i data-feather='eye'></i>
                            </button>
                        </div>
                    </div>

                </div>
    @endif
@if($SubSavingAccountBalance > 0 && $subAccounts == 0)
                <div class="row bg-white p-1">
                    <div class="col-10 ">
                        <h5> <b>@lang('Liquid Cash Account')</b></h5>

                        <h3 class="mb-75 mt-2 pt-50">
                            <a href="{{ route('user.subsaving.index') }}"> {{ $general->cur_sym }}
                                {{ showAmount($SubSavingAccountBalance) }}</a>
                        </h3>
                    </div>

                    <div class="col-2">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-container="body" title=""
                                aria-describedby="popover343370">
                                <i data-feather='eye'></i>
                            </button>
                        </div>
                    </div>

                </div>

    @endif

    @if ($subAccounts == 0)

        <div class="row">

            {{-- @if ($loan || $bal) --}}
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-body pb-50">
                        <h6>Active Loan</h6>
                        <h4 class="fw-bolder mb-1">{{ $general->cur_sym }}{{ @number_format($loan, 2) }}</h4>
                        <div id="statistics-order-chart"></div>
                    </div>
                </div>
            </div>
            <!--/ Bar Chart - Orders -->
        
            <!-- Line Chart - Profit -->
            <div class="col-md-6 col-12">
                <div class="card card-tiny-line-stats">
                    <div class="card-body pb-50">
                        <h6>Loan Balance</h6>
                        <h4 class="fw-bolder mb-1">{{ $general->cur_sym }}{{ @number_format($bal, 2) }}</h4>
                        <div id="statistics-profit-chart"></div>
                    </div>
                </div>
            </div>
            {{-- @endif --}}
        </div>
    @endif

    {{-- </div> --}}
</div>
@if ($subAccounts > 0)

{{-- <div class="row"> --}}

    {{-- @if ($loan || $bal) --}}
    <div class="col-md-2 col-12">
        <div class="card">
            <div class="card-body pb-50">
                <h6>Active Loan</h6>
                <h4 class="fw-bolder mb-1">{{ $general->cur_sym }}{{ @number_format($loan, 2) }}</h4>
                <div id="statistics-order-chart"></div>
            </div>
        </div>
    </div>
    <!--/ Bar Chart - Orders -->

    <!-- Line Chart - Profit -->
    <div class="col-md-2 col-12">
        <div class="card card-tiny-line-stats">
            <div class="card-body pb-50">
                <h6>Loan Balance</h6>
                <h4 class="fw-bolder mb-1">{{ $general->cur_sym }}{{ @number_format($bal, 2) }}</h4>
                <div id="statistics-profit-chart"></div>
            </div>
        </div>
    </div>
    {{-- @endif --}}
{{-- </div> --}}
@endif

</div>

    <div class="row text-center">
        <div class="col-lg-3 col-12">
        </div>

            <div class="col-lg-6 col-12">
            <div class="row match-height">
                <div class="col-lg-12 col-md-6 col-12">
                    <div class="bg-transparent card earnings-card shadow-none">
                        <div class="row">
                            <div class="col-12">
                            <div class="col-12">
                                @foreach($dashboardImages as $dashboardImage)
                                <a target="_blank" href="{{$dashboardImage->image_url}}">
                                <img class="img-fluid"
                                    src="{{ getImage(imagePath()['dashboardSlide']['path'] . '/slide.png') }}"
                                    height="110" alt="logo">
                                </a>
                    @endforeach
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-12">

    </div>
</div>

        <!-- Revenue Report Card -->
        {{-- <div class="col-lg-7 col-12 mb-1">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse($dashboardSlides as $dashboardSlide)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ getImage(imagePath()['dashboardSlide']['path'] . '/' . $dashboardSlide->path) }}"
                            class="d-block w-100 bg-white" alt="logo">
                    </div>
                    @empty
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div> --}}
        <!--/ Revenue Report Card -->
    {{-- </div> --}}
</section>
<!-- Dashboard Ecommerce ends -->

<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce" class="d-sm-none">
    <div class="row match-height">
        <!-- Medal Card -->

        @if ($general->news && session('news-close'))
        <section id="alerts-with-icons">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-text">Update & News</h4>
                    <div class="alert alert-primary alert-dismissible fade show p-1" role="alert">
                        <i data-feather="star" class="me-50"></i>
                        <span> {{ $general->news }}</span>
                        <button type="button" class="btn-close news-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Greetings Card starts -->
        <div class="col-lg-12 col-md-12 col-sm-12 mt-1">
            <div class="card card-congratulations">
                <div class="card-body text-center">
                    <img src="{{ asset($activeTemplateTrue . 'app-assets/images/elements/decore-left.png') }}"
                        class="congratulations-img-left" alt="card-img-left" />
                    <img src="{{ asset($activeTemplateTrue . 'app-assets/images/elements/decore-right.png') }}"
                        class="congratulations-img-right" alt="card-img-right" />
                    <div class="avatar avatar-xl bg-primary shadow">
                        <div class="avatar-content">
                            <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png', '?' . time()) }}"
                                alt="avatar" />
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="mb-1 text-white">Welcome {{ Auth::user()->username }},</h1>
                    </div>
                    <a class="btn btn-primary btn-sm mt-1"
                        href="{{ route('user.transfers.index') }}">{{ __('Send Fund') }} <i
                            data-feather='arrow-right'></i></a>
                    <a class="btn btn-primary btn-sm mt-1"
                        href="{{ route('user.withdraw-methods.index') }}">{{ __('Cash Out') }} <i
                            data-feather='credit-card'></i></a>
                    <a class="btn btn-primary btn-sm mt-1" href="{{ route('user.support') }}">{{ __('Bill Pay') }} <i
                            data-feather='dollar-sign'></i></a>
                </div>
            </div>
        </div>
        <!-- Greetings Card ends -->

        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-primary">
                <div class="card-body">
                    <h5> <b>@lang('Premier Account Balance')</b></h5>
                    <h3 class="mb-75 mt-2 pt-50">
                        <a href="#"> {{ $general->cur_sym }} {{ showAmount($user->balance) }}</a>
                    </h3>
                    @if ($pendingDeposit == 0)
                    <div class="row mt-2">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-container="body" title=""
                                data-bs-content="{{ Auth::user()->account_number }}"
                                data-bs-original-title="Account No." aria-describedby="popover343370">
                                <i data-feather='eye'></i>
                            </button>
                        </div>
                        <div class="col-12 text-end">
                            <a href="{{ route('user.deposits.index') }}"
                                class="btn btn-primary text-end mt-1">{{ __('Deposit') }}</a>
                        </div>
                    </div>
                    @endif
                    @if ($pendingDeposit > 0)
                    <div class="row mt-4">
                        <div class="col-md-8 col-12 pb-50">
                            <h5> <b>@lang('Pending Deposit')</b></h5>
                            <h3 class="mb-75 mt-2 pt-30">
                                <a href="#"> {{ $general->cur_sym }} {{ showAmount($pendingDeposit) }}</a>
                            </h3>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-dark btn-md d-block float-end"
                                    data-bs-toggle="popover" data-bs-placement="top" data-bs-container="body" title=""
                                    data-bs-content="{{ Auth::user()->account_number }}"
                                    data-bs-original-title="Account No." aria-describedby="popover343370">
                                    <i data-feather='eye'></i>
                                </button>
                            </div>
                            <div class="col-12 text-end ">
                                <a href="{{ route('user.deposits.index') }}"
                                    class="btn btn-primary float-end mx-1">{{ __('Deposit') }}</a>
                            </div>
                        </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-12">
            <div class="card">
                <div class="card-body mb-1 text-center">
                    <a class="btn btn-primary btn-sm mt-1"
                        href="{{ route('user.transfers.index') }}">{{ __('Send Fund') }} <i
                            data-feather='arrow-right'></i></a>
                    <a class="btn btn-primary btn-sm mt-1"
                        href="{{ route('user.withdraw-methods.index') }}">{{ __('Cash Out') }} <i
                            data-feather='credit-card'></i></a>
                    <a class="btn btn-primary btn-sm mt-1" href="{{ route('user.support') }}">{{ __('Bill Pay') }} <i
                            data-feather='dollar-sign'></i></a>
                </div>
            </div>
        </div> -->
        @if ($subAccounts > 0)
        <div class="col-xl-4 col-md-6 col-12">

            <div class="card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-6 ">
                            <h5> <b>@lang('Saving Account')</b></h5>

                            <h3 class="mb-75 mt-2 pt-50">
                                <a href="{{ route('user.mysavings') }}"> {{ $general->cur_sym }}
                                    {{ showAmount($saved) }}</a>
                            </h3>
                        </div>

                        <div class="col-6">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-dark btn-sm d-block float-end"
                                    data-bs-toggle="popover" data-bs-placement="top" data-bs-container="body" title=""
                                    aria-describedby="popover343370">
                                    <i data-feather='eye'></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-10 ">
                        <h5> <b>@lang('Liquid Cash Account')</b></h5>

                        <h3 class="mb-75 mt-2 pt-50">
                            <a href="{{ route('user.subsaving.index') }}"> {{ $general->cur_sym }}
                                {{ showAmount($SubSavingAccountBalance) }}</a>
                        </h3>
                    </div>

                    <div class="col-2">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-dark btn-sm d-block float-end" data-bs-toggle="popover"
                                data-bs-placement="top" data-bs-container="body" title=""
                                aria-describedby="popover343370">
                                <i data-feather='eye'></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- @if (session('savings-close'))
    <div class="col-12">
        <div class="alert alert-primary alert-dismissible fade show p-1" role="alert">
            <h4 class="mb-1">{{ __('Liquid Cashs Account') }}</h4>
            <a class="btn btn-primary" href="{{ route('user.savingbalance') }}">{{ __('See All') }}</a>
            <a class="btn btn-primary" href="{{ route('user.savings.request') }}">{{ __('Add New') }}</a>
            <button type="button" class="btn-close savings-close text-light" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    </div>
    @endif --}}

    @if ($loan || $bal)
    <div class="col-md-4 col-6">
        <div class="card">
            <div class="card-body pb-50">
                <h6>Active Loan</h6>
                <h4 class="fw-bolder mb-1">{{ $general->cur_sym }}{{ @number_format($loan, 2) }}</h4>
                <div id="statistics-order-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-6">
        <div class="card card-tiny-line-stats">
            <div class="card-body pb-50">
                <h6>Loan Balance</h6>
                <h4 class="fw-bolder mb-1">{{ $general->cur_sym }}{{ @number_format($bal, 2) }}</h4>
                <div id="statistics-profit-chart"></div>
            </div>
        </div>
    </div>
    @endif
    </div>


    <div class="row match-height">
        @if (session('ads-close'))
        <div class="col-12">
            <div class="alert alert-light alert-dismissible fade show p-1" role="alert">
                <div class="row match-height">
                    <div class="col-lg-12 col-md-6 col-12">
                        <div class="bg-transparent card earnings-card shadow-none">
                            <div class="row">
                                <div class="col-12">
                                    <img class="img-fluid"
                                        src="{{ getImage(imagePath()['dashboardSlide']['path'] . '/slide.png') }}"
                                        height="110" alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close text-light ads-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="col-lg-12 mb-1">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse($dashboardSlides as $dashboardSlide)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img height="200"
                            src="{{ getImage(imagePath()['dashboardSlide']['path'] . '/' . $dashboardSlide->path) }}"
                            class="d-block w-100 bg-white" alt="logo">
                    </div>
                    @empty
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Ecommerce ends -->

<!-- Dashboard Footer Starts -->
<div class="dashboard-dynamic-footer bg-black fw-bold p-2 text-white w-100">
    <div class="">{{ $dashboardFooter[0]->data_text }}</div>
    <div class="">{{ $dashboardFooter[1]->data_text }}</div>
    <div class="">
        @forelse ($dashboardFooter as $element)
        @if ($element->data_type == 'element.textlink')
        <a class="btn-flat-primary" target="_blank" href="{{ $element->data_text2 }}">{{ $element->data_text }}</a>
        &nbsp;
        @elseif ($element->data_type == 'element.iconlink')
        @endif

        @empty
        @endforelse
    </div>
</div>
<!-- Dashboard Footer Ends -->
</div>
</div>
@endsection

@push('style')
<style>
.w-30 {
    width: 30px;
}

.h-30 {
    height: 30px;
}

.card-primary {
    border-top: 2px solid #7367F0;
}
</style>
@endpush

@push('script')
@include('partials.chart')
<script src="{{ asset($activeTemplateTrue . 'front/layout2/js/tether.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'front/layout2/js/bootstrap.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/pages/dashboard-ecommerce.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/components/components-popovers.min.js') }}"></script>
<script>
$('.ads-close').on('click', function() {
    {
        {
            session() - > forget('ads-close')
        }
    }
})
$('.news-close').on('click', function() {
    {
        {
            Session::put('news-close', 0)
        }
    }
})
$('.savings-close').on('click', function() {
    {
        {
            Session::put('savings-close', 0)
        }
    }
})
</script>
@endpush