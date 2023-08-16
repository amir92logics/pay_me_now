@extends($activeTemplate.'layouts.dashboard')
@section('content')

<!-- Earnings Card -->
<div style="width: 50%;">
    <div class="card earnings-card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h4 class="card-title mb-1">Total Loan</h4>
                    <div class="font-small-2">Year {{date('Y')}}</div>
                    <h5 class="mb-1">{{$general->cur_sym}}{{@number_format($yloan, 2)}}</h5>
                    <p class="card-text text-muted font-small-2">
                        <span class="fw-bolder">Pay Loan ASAP</span><span> and increase your credibility score on {{$general->sitename}}.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Earnings Card -->
@endsection