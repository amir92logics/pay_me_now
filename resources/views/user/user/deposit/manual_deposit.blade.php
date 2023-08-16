@extends($activeTemplate.'layouts.dashboard')


@section('content')

@push('style')

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/forms/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/forms/form-wizard.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/forms/select/select2.min.css')}}">
<!-- END: Page CSS-->
@endpush

<!-- Deposit Wizard -->
<form action="{{route('user.deposit.manual')}}" method="post" enctype="multipart/form-data">
  @csrf
  <section class="horizontal-wizard">
    <div class="bs-stepper horizontal-wizard-example">
      <div class="bs-stepper-header" role="tablist">
        <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
          <button type="button" class="step-trigger">
            <span class="bs-stepper-box">1</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Payment Gateway</span>
              <span class="bs-stepper-subtitle">Step 1</span>
            </span>
          </button>
        </div>


      </div>
      <div class="bs-stepper-content">
        <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
          <div class="content-header">
            <h5 class="mb-0">Payment Gateway</h5>
            <!-- <small class="text-muted">Please Select A Payment Gateway</small> -->
          </div>
          <div class="row">
            <div class="mb-1 col-md-6">
              <label class="form-label" for="username">Method</label>
              <input type="text" value="{{ $gatewayCurrency->name }}" readonly class="form-control" />
            </div>
            <div class="mb-1 col-md-6">
              <label class="form-label" for="email">Currency</label>
              <input type="text" name="currency" id="currency" value="{{ $gatewayCurrency->currency }}" readonly class="form-control" placeholder="{{$general->cur_text}}" aria-label="{{$general->cur_text}}" />
            </div>
            <input type="hidden" id="method_code" name="method_code" value="{{ $gatewayCurrency->method_code }}">
          </div>
          <div class="row">
            <div class="mb-1 form-password-toggle col-md-6">
              <label class="form-label" for="Min">Min Amount</label>
              <input type="text" readonly name="min" id="min" value="{{ showAmount($gatewayCurrency->min_amount) }}" class="form-control" placeholder="0.00" />
            </div>
            <div class="mb-1 form-password-toggle col-md-6">
              <label class="form-label" for="Max">Max Amount</label>
              <input type="text" readonly name="max" id="max" value="{{ showAmount($gatewayCurrency->max_amount) }}" class="form-control" placeholder="0.00" />
            </div>
          </div>
          <div class="row">
            <div class="mb-1 col-md-12">
              <label class="form-label" for="first-name">Amount</label>
              <input type="text" name="amount" id="amount" class="form-control" placeholder="0.00" />
            </div>
          </div>
          <div class="row">
            @if($gatewayCurrency->gateway_parameter)

            @foreach(json_decode($gatewayCurrency->gateway_parameter) as $k => $v)

            @if($v->type == "text")
            <div class="col-md-12">
              <div class="form-group mb-1">
                <label><strong>{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span> @endif</strong></label>
                <input type="text" class="form-control" name="{{$k}}" value="{{old($k)}}" placeholder="{{__($v->field_level)}}">
              </div>
            </div>
            @elseif($v->type == "textarea")
            <div class="col-md-12">
              <div class="form-group mb-1">
                <label><strong>{{__(inputTitle($v->field_level))}} @if($v->validation == 'required') <span class="text-danger">*</span> @endif</strong></label>
                <textarea name="{{$k}}" class="form-control" placeholder="{{__($v->field_level)}}" rows="3">{{old($k)}}</textarea>

              </div>
            </div>
            @elseif($v->type == "file")
            <div class="col-md-12">
              <div class="form-group mb-1">
                <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span> @endif</strong></label>
                <br>

                <div class="fileinput fileinput-new " data-provides="fileinput">
                  <div class="fileinput-new thumbnail withdraw-thumbnail" data-trigger="fileinput">
                    <img src="{{ asset(getImage('/')) }}" alt="@lang('Image')">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>

                  <div class="img-input-div">
                    <span class="btn btn-info btn-file">
                      <span class="fileinput-new "> @lang('Select') {{__($v->field_level)}}</span>
                      <span class="fileinput-exists"> @lang('Change')</span>
                      <input type="file" name="{{$k}}" accept="image/*">
                    </span>
                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> @lang('Remove')</a>
                  </div>
                </div>

              </div>
            </div>
            @endif
            @endforeach
            @endif
          </div>
          <div class="d-flex justify-content-between">
            <button class="btn btn--primary text-white btn-next">
              <span class="align-middle">Pay</span>
              <!-- <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i> -->
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
<!-- /Deposit Wizard -->

@endsection
@push('style')
<style>
  .withdraw-thumbnail {
    max-width: 220px;
    max-height: 220px
  }
</style>
@endpush
@push('script-lib')
<script src="{{asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')}}"></script>
@endpush
@push('style-lib')
<link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">
@endpush


@push('style')
<style>
  .fileinput .thumbnail {
    max-height: 300px;
    width: 100%;
  }
</style>
@endpush

@push('script')
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/forms/form-wizard.min.js')}}"></script>

<script>
  (function($) {

    "use strict";

    $('.withdraw-thumbnail').hide();

    $('.clickBtn').on('click', function() {

      var classNmae = $('.fileinput').attr('class');

      if (classNmae != 'fileinput fileinput-exists') {
        $('.withdraw-thumbnail').hide();
      } else {

        $('.fileinput-preview img').css({
          "width": "100%",
          "height": "300px",
          "object-fit": "contain"
        });

        $('.withdraw-thumbnail').show();

      }

    });

  })(jQuery);
</script>
@endpush