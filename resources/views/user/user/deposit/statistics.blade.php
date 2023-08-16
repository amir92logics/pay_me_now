@extends($activeTemplate.'layouts.dashboard')
@section('content')

<div class="row ">
    <!-- Company Table Card -->
    <div class="col-lg-12 col-12">
        <!-- Statistics Card -->
        <div class="card card-statistics">
            <div class="card-header">
                <h4 class="card-title">Statistics</h4>
                <div class="d-flex align-items-center">
                    <p class="card-text font-small-2 me-25 mb-0">Financial Stat</p>
                </div>
            </div>
            <div class="card-body statistics-body">
                <div class="row">
                    <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-success me-2">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0"> {{ $general->cur_sym }}
                                    {{ showAmount($totalDeposit) }}
                                </h4>
                                <p class="card-text font-small-3 mb-0">@lang('Total Deposit')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                        <div class="d-flex flex-row">
                            <div class="avatar bg-light-danger me-2">
                                <div class="avatar-content">
                                    <i data-feather="shopping-cart" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="my-auto">
                                <h4 class="fw-bolder mb-0">{{ $general->cur_sym }}
                                    {{ showAmount($totalWithdraw) }}
                                </h4>
                                <p class="card-text font-small-3 mb-0">@lang('Total Withdraw')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>
    <!--/ Company Table Card -->
</div>


@endsection



@push('style')
<style>
    .list-group-item {
        background: transparent;
    }
</style>
@endpush