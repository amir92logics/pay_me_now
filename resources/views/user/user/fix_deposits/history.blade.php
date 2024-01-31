@extends($activeTemplate.'layouts.dashboard')
@section('content')

<!-- Revenue Report Card -->
<div class="col-lg-8 col-12">
    <div class="card card-revenue-budget">
        <div class="row mx-0">
            <div class="col-md-12 col-12 revenue-report-wrapper">
                <div class="d-sm-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-50 mb-sm-0">Fixed Deposits Balance: {{$general->cur_sym}}{{@number_format($saved, 2)}}</h4>
                   <!-- <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center me-2">
                            <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                            <span>Target</span>
                        </div>
                        <div class="d-flex align-items-center ms-75">
                            <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                            <span>Recurrent</span>
                        </div>
                    </div>-->
                </div>
                <div id="revenue-report-chart"></div>
            </div>

        </div>
    </div>
</div>
<!--/ Revenue Report Card -->
@endsection