@extends($activeTemplate.'layouts.dashboard')


@section('content')

@push('style')

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/forms/form-wizard.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
    <link rel="stylesheet" type="text/css" href=".{{ asset($activeTemplateTrue. 'app-assets/vendors/css/forms/select/select2.min.css')}}">
    <!-- END: Page CSS-->
@endpush

<!-- Deposit Wizard -->
<form action="{{route('user.investment')}}" method="post">
@csrf
<section class="horizontal-wizard">
  <div class="bs-stepper horizontal-wizard-example">
    <div class="bs-stepper-header" role="tablist">
      <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
        <button type="button" class="step-trigger">
          <span class="bs-stepper-box">1</span>
          <span class="bs-stepper-label">
            <span class="bs-stepper-title">{{$pageTitle}}</span>
            <span class="bs-stepper-subtitle">Step 1</span>
          </span>
        </button>
      </div>


    </div>
    <div class="bs-stepper-content">
      <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
        <div class="content-header">
          <h5 class="mb-0">Investment Plan</h5>
          <small class="text-muted">Please Select A Plan</small>
        </div>
          <div class="row">
          <p id="image"></p>
            <div class="mb-1 col-md-12">
              <label class="form-label" for="username">Plan</label>
              <select id="gateway" onchange="myFunction()" name="plan" class="form-control">
              <option selected disabled>Select An Option</option>
              @foreach($plan as $singlePlan)
              <option
                               data-id="{{$singlePlan->id}}"
                               data-resource="{{$singlePlan}}"
                               data-tenure="{{$singlePlan->total_return}} Days"
                               data-min_amount="{{ $general->cur_sym }}{{ showAmount($singlePlan->min_amount, 0) }}"
                               data-max_amount="{{ $general->cur_sym }}{{ showAmount($singlePlan->max_amount, 0) }}"
                               data-interest="{{ showAmount($singlePlan->interest_amount) }}{{ $singlePlan->interest_type == 0 ? 'Fixed' : '%' }}"

              > {{__($singlePlan->name)}}</option>
              @endforeach
              </select>
              @push('script')
<script>
function myFunction() {
var method_code = $("#gateway option:selected").attr('data-id');
var tenure = $("#gateway option:selected").attr('data-tenure');
var interest = $("#gateway option:selected").attr('data-interest');
var min_amount = $("#gateway option:selected").attr('data-min_amount');
var max_amount = $("#gateway option:selected").attr('data-max_amount');
document.getElementById("min").value = min_amount;
document.getElementById("max").value = max_amount;
document.getElementById("interest").value = interest;
document.getElementById("tenure").value = tenure;
document.getElementById("method_code").value = method_code;

 };
</script>
@endpush
            </div>
            <div class="mb-1 col-md-6">
              <label class="form-label" for="email">Tenure</label>
              <input
                type="text"
                name="tenure"
                id="tenure" readonly
                class="form-control"
                placeholder="0 Days"
                aria-label="0 Days"
              />
            </div>

             <div class="mb-1 col-md-6">
              <label class="form-label" for="email">Interest</label>
              <input
                type="text"
                name="currency"
                id="interest" readonly
                class="form-control"
                placeholder="0"
                aria-label="0"
              />
            </div>

                <input type="hidden" id="method_code" name="plan">
          </div>

          <div class="row">
            <div class="mb-1 form-password-toggle col-md-6">
              <label class="form-label" for="Min">Min Amount</label>
              <input
                type="text" readonly
                name="min"
                id="min"
                class="form-control"
                placeholder="0.00"
              />
            </div>
            <div class="mb-1 form-password-toggle col-md-6">
              <label class="form-label" for="Max">Max Amount</label>
              <input
                type="text" readonly
                name="max"
                id="max"
                class="form-control"
                placeholder="0.00"
              />
            </div>
          </div>

           <div class="row">
            <div class="mb-1 col-md-12">
              <label class="form-label" for="first-name">Amount</label>
              <input type="text" name="amount" id="amount" class="form-control" placeholder="0.00" />
            </div>
          </div>
        <div class="d-flex justify-content-between">

          <button class="btn btn--primary text-white btn-next">
            <span class="align-middle d-sm-inline-block d-none">@lang('Invest Now')</span>
            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
<!-- /Deposit Wizard -->

@endsection



@push('script')
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/forms/form-wizard.min.js')}}"></script>

@endpush

