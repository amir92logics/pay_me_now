@extends($activeTemplate . 'layouts.dashboard')

@section('content')
<div class="row justify-content-center">
    @if (session('success_msg'))
        <div class="col-8">
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    <strong>{{ __('Success!') }}</strong> {{ session('success_msg') }}
                </div>
            </div>
        </div>
    @endif
    <div class="col-sm-10 search-table">
        <div class="card radius-card">
            <div class="card-header">
                <h3 class="text-primary">
                    <a href="{{ route('user.withdraw-methods.index') }}" class="btn btn-primary btn-sm rounded-pill"><i data-feather='arrow-left-circle'></i> Back</a>
                    {{ __('An OTP has been sended to your mail. Please check and confirm.') }}
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.payout.success', request('method_id')) }}" method="post" class="mb-3 ajaxform_instant_reload">
                    @csrf
                    <div class="input-group input-group-merge mb-2">
                        <input type="number" step="any" class="form-control" required placeholder="OTP" name="otp" aria-describedby="basic-addon-search2">
                        <button class="input-group-text btn btn-primary submit-btn" id="basic-addon-search2" type="submit">Confirm</button>
                    </div>
                </form>
                @php
                    $payout_amount = session('payout_amount');
                    $method_charge = session('method_charge');
                    $available_amount = $payout_amount - $method_charge;
                @endphp
                <div class="d-flex justify-content-between">
                    <h4>{{ __('Your current balance is') }}</h4>
                    <h4 class="font-weight-bold">{{ '$'.auth()->user()->balance }}</h4>
                </div>
                <div class="d-flex justify-content-between">
                    <h4>{{ __('Your withdraw request amount') }}</h4>
                    <h4 class="font-weight-bold">{{ '$'.$payout_amount }}</h4>
                </div>
                <div class="d-flex justify-content-between">
                    <h4>{{ __('Total charge') }}</h4>
                    <h4 class="font-weight-bold">{{ '$'.$method_charge }}</h4>
                </div>
                <div class="d-flex justify-content-between">
                    <h4>{{ __('You will Receive Amount') }}</h4>
                    <h4 class="font-weight-bold">{{ '$'.$available_amount }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
