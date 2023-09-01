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
<form action="" method="post">
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
          <h5 class="mb-0">Savings Plans</h5>
          <small class="text-muted">Please Select A Savings Plan</small>
        </div>
          <div class="row">

            <div class="mb-1 col-md-12">
            <div class="alert alert-warning" role="alert">
              <div class="alert-body"><strong>Note!</strong>Please note that your savings plan will be serviced from the fund from your deposit wallet..</div>
            </div>
          </div>


            <div class="mb-1 col-md-12">
              <label class="form-label" for="username">Plan</label>
              <select onchange="myFunction()" id="first" name="" class="select form-select" id="select2-basic">
              <option selected disabled>Select An Option</option>
              @foreach ($plans as $data)
                                        <option value="{{ $data->id+1 }}" data-id="{{ $data->id }}" data-resource="{{ $data }}"
                                        data-name="{{$data->name }}"
                                            data-min_amount="{{ showAmount($data->min) }}{{ __($general->cur_text) }}"
                                            data-max_amount="{{ showAmount($data->max) }}{{ __($general->cur_text) }}"
                                            data-duration="{{ $data->duration }}"> {{ __($data->name) }}
                                        </option>
                                    @endforeach
              <!--
               <option value="1">Recurrent Savings</option>
            <option value="2">Target Savings</option> -->
              </select>
              <div class="mb-1 col-md-6">
                                <label class="form-label" for="email">Saving Plan Name</label>
                                <input type="text" id="name" readonly class="form-control" placeholder="name"
                                    aria-label="0" />
                            </div>

                            <input type="hidden" id="method_code" name="plan">

                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="Min">Min Amount</label>
                                <input type="text" readonly name="min" id="min" class="form-control"
                                    placeholder="0.00" />
                            </div>
                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="Max">Max Amount</label>
                                <input type="text" readonly name="max" id="max" class="form-control"
                                    placeholder="0.00" />
                            </div>
                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="duration">Duration (Months)</label>
                                <input readonly type="text" name="duration" id="duration" class="form-control"
                                    placeholder="Duration" />
                            </div>
@push('script')
<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#first").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")=="1"){
                $(".box").not(".red").hide();
                $(".red").show();
            }
            else if($(this).attr("value")=="2"){
                $(".box").not(".green").hide();
                $(".green").show();
            }

            else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>

@endpush
            </div>

             <div class="mb-1 col-md-12 red box">
            <div class="alert alert-primary" role="alert">
              <div class="alert-body"><strong>Note!</strong> Choosing this plan implies that any amount entered in the amount field below will be charged from your deposit wallet at interval using the set recurrent cycle. You wont have access to this fund until the recurrent cycle is complete</div>
            </div>
          </div>

            <div class="mb-1 col-md-12 red box">

              <label class="form-label" for="email">Recurrent Cycle</label>
              <select name="cycle" class="form-control">
              <option selected disabled>Select An Option</option>
               <option value="1">Daily</option>
            <option value="7">Weekly</option>
            <option value="30">Monthly</option>
              </select>
            </div>



             <div class="mb-1 form-password-toggle col-md-12  red box">
              <label class="form-label" for="Min">Recurrent Times</label>
              <input
                type="number"
                name="recurrent"

                class="form-control"
                placeholder="Enter the number of recurrent"
              />
            </div>

             <div class="mb-1 form-password-toggle col-md-12  red box">
              <label class="form-label" for="Min">Recurrent Savings Amount </label>
              <input
                type="number"
                name="ramount"

                class="form-control"
                placeholder="0.00"
              />
            </div>

          </div>

          <div class="row  green box">

           <div class="demo-spacing-0">
            <div class="alert alert-primary" role="alert">
              <div class="alert-body"><strong>Note!</strong> Please note that you will not have access to any fund saved on this plan until it completes the targeted amount or the maturity date elapses..</div>
            </div>
          </div>
          <br>


            <div class="mb-1 form-password-toggle col-md-12">
            <br>
              <label class="form-label" for="Min">Enter Target Amount </label>
              <input
                type="number"
                name="tamount"

                class="form-control"
                placeholder="0.00"
              />
            </div>

            <div class="mb-1 form-password-toggle col-md-12">
            <br>
              <label class="form-label" for="Min">Enter Maturity Date </label>
              <input
                type="date"
                name="mature"

                class="form-control"
                placeholder="Enter Date"
              />
            </div>


          </div>


        <div class="d-flex justify-content-between">

          <button class="btn btn-primary btn-next">
            <span class="align-middle d-sm-inline-block d-none">Proceed</span>
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
<script>
        function myFunction() {
            var plan_id = $("#first option:selected").attr('data-id');
            var name = $("#first option:selected").attr('data-name');
            var duration = $("#first option:selected").attr('data-duration');
            var min_amount = $("#first option:selected").attr('data-min_amount');
            var max_amount = $("#first option:selected").attr('data-max_amount');
            document.getElementById("name").value = name;
            document.getElementById("min").value = min_amount;
            document.getElementById("max").value = max_amount;
            document.getElementById("duration").value = duration + " Months";

            $.ajax({
                type: 'GET',
                url: $('#plan-url').val(),
                data: {
                    plan_id:plan_id
                },
                success: function (res) {
                    $('#plan-inputs').append(res.data);
                    console.log(res);
                }
            });
        };
        </script>
@endpush

