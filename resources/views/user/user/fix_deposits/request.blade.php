@extends($activeTemplate . 'layouts.dashboard')


@section('content')
    @push('style')
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset($activeTemplateTrue . 'app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset($activeTemplateTrue . 'app-assets/css/plugins/forms/form-validation.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset($activeTemplateTrue . 'app-assets/css/plugins/forms/form-wizard.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href=".{{ asset($activeTemplateTrue . 'app-assets/vendors/css/forms/select/select2.min.css') }}">
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
                                <span class="bs-stepper-title">{{ $pageTitle }}</span>
                                <span class="bs-stepper-subtitle">Step 1</span>
                            </span>
                        </button>
                    </div>


                </div>
                <div class="bs-stepper-content">
                    <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
                        <div class="content-header">
                            <h5 class="mb-0">Interest Bearing Plans</h5>
                            <small class="text-muted">Please Select A Plan</small>
                        </div>
                        <div class="row">

                            <div class="mb-1 col-md-12">
                                <div class="alert alert-warning" role="alert">
                                    <div class="alert-body"><strong>Note!</strong>Please note that your Deposit plan will be
                                        serviced from the fund from your deposit wallet..</div>
                                </div>
                            </div>


                            <div class="mb-1 col-md-12">
                                <label class="form-label" for="username">Plan</label>
                                <select onchange="myFunction()" id="first" name="" class="select form-select"
                                    id="select2-basic">
                                    <option selected disabled>Select An Option</option>
                                    @foreach ($plans as $data)
                                    
                                        <option value="{{ $data->id}}" data-id="{{ $data->id }}"
                                            data-resource="{{ $data }}" data-name="{{ $data->name }}"
                                            data-min_amount="{{ showAmount($data->min_amount) }}{{ __($general->cur_text) }}"
                                            data-max_amount="{{ showAmount($data->max_amount) }}{{ __($general->cur_text) }}"
                                            data-duration="{{ $data->timer }}"
                                            data-interest_type="{{ $data->interest_type}}"
                                            data-interest_amount="{{ $data->interest_amount}}"
                                            {{-- data-total_return="{{ $data->total_return}}" --}}
                                            > {{ __($data->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">Deposit Plan Name</label>
                                        <input type="text" id="name" readonly class="form-control"
                                            placeholder="name" aria-label="0" />
                                    </div>

                                    <input type="hidden" id="plan" name="plan">

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
                                     <div class="mb-1 form-password-toggle col-md-6">
                                        <label class="form-label" for="interest_type">Interest Type</label>
                                        <input readonly type="text" name="interest_type" id="interest_type" class="form-control"
                                            placeholder="Interest Type" />
                                    </div>
                                     <div class="mb-1 form-password-toggle col-md-6">
                                        <label class="form-label" for="interest_amount">Interest Amount</label>
                                        <input readonly type="text" name="interest_amount" id="interest_amount" class="form-control"
                                            placeholder="Interest Amount" />
                                    </div>
                                     {{-- <div class="mb-1 form-password-toggle col-md-6">
                                        <label class="form-label" for="total_return">Total Return</label>
                                        <input readonly type="text" name="total_return" id="total_return" class="form-control"
                                            placeholder="Total Return" />
                                    </div> --}}
                                </div>
                                @push('script')
                                    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $("#first").change(function() {
                                                $(this).find("option:selected").each(function() {
                                                    if ($(this).attr("value") > 0) {
                                                        $(".red").show();
                                                    } else {
                                                        $(".red").hide();
                                                    }
                                                });
                                            }).change();
                                        });
                                    </script>
                                @endpush
                            </div>

                           

                            <div class="mb-1 form-password-toggle col-md-12  red box">
                                <label class="form-label" for="Min">Enter Deposit Amount </label>
                                <input type="number" name="famount" class="form-control" placeholder="0.00" />
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
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}">
    </script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/forms/form-wizard.min.js') }}"></script>
    <script>
        function myFunction() {
            var plan_id = $("#first option:selected").attr('data-id');
            var name = $("#first option:selected").attr('data-name');
            var duration = $("#first option:selected").attr('data-duration');
            var min_amount = $("#first option:selected").attr('data-min_amount');
            var max_amount = $("#first option:selected").attr('data-max_amount');
            var interest_type = $("#first option:selected").attr('data-interest_type');
            var interest_amount = $("#first option:selected").attr('data-interest_amount');
            {{-- var total_return = $("#first option:selected").attr('data-total_return'); --}}

            document.getElementById("plan").value = plan_id ? plan_id : '' ;
            document.getElementById("name").value = name ? name : '' ;
            document.getElementById("min").value = min_amount ? min_amount : '' ;
            document.getElementById("max").value = max_amount ? max_amount : '' ;
            document.getElementById("interest_type").value = 'Percent';
            {{-- document.getElementById("interest_type").value = interest_type ? interest_type == 0 ? 'Fixed' : 'Percent' : ''  ; --}}
            document.getElementById("interest_amount").value = interest_amount ? (interest_amount + (interest_type == 0 ? ' USD' : ' %')) : '' ;
            {{-- document.getElementById("total_return").value = total_return ? total_return : '' ; --}}
            document.getElementById("duration").value = duration ? duration + " Months"  : '' ;

            $.ajax({
                type: 'GET',
                url: $('#plan-url').val(),
                data: {
                    plan_id: plan_id
                },
                success: function(res) {
                    $('#plan-inputs').append(res.data);
                    console.log(res);
                }
            });
        };
    </script>
@endpush
