@extends($activeTemplate . 'layouts.dashboard')


@section('content')
    @push('style')
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/plugins/forms/form-validation.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/plugins/forms/form-wizard.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/forms/wizard/bs-stepper.min.css') }}">
        <link rel="stylesheet" type="text/css" href=".{{ asset($activeTemplateTrue . 'app-assets/vendors/css/forms/select/select2.min.css') }}">
        <!-- END: Page CSS-->
    @endpush

    <!-- Deposit Wizard -->
    <form action="" method="post" enctype="multipart/form-data">
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
                            <h5 class="mb-0">Loan Plans</h5>
                            <small class="text-muted">Please Select A Loan Plan</small>
                        </div>
                        <div class="row" id="plan-inputs">
                            <div class="mb-1 col-md-12">
                                <label class="form-label" for="select2-basic">Plan</label>
                                <select id="gateway" onchange="myFunction()" name="" class="select form-select" id="select2-basic">
                                    <option selected disabled>Select An Option</option>
                                    @foreach ($plans as $data)
                                        <option data-id="{{ $data->id }}" data-resource="{{ $data }}"
                                            data-min_amount="{{ showAmount($data->min) }}{{ __($general->cur_text) }}"
                                            data-max_amount="{{ showAmount($data->max) }}{{ __($general->cur_text) }}"
                                            data-duration="{{ $data->duration }}"
                                            data-percent_charge="{{ showAmount($data->fee) }}"
                                            data-base_symbol="{{ __($general->cur_text) }}"> {{ __($data->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="email">Duration</label>
                                <input type="text" id="duration" readonly class="form-control" placeholder="0 Months"
                                    aria-label="0" />
                            </div>

                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="email">Percentage Interest</label>
                                <input type="text" id="pcharge" readonly class="form-control" placeholder="0%"
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

                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="first-name">Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control"
                                    placeholder="0.00" />
                            </div>

                            <div class="mb-1 col-md-12">
                                <label class="form-label" for="duration">Duration (Months)</label>
                                <input type="number" name="duration" id="duration" class="form-control"
                                    placeholder="Enter Loan Duration" />
                            </div>
                            
                            <div class="mb-1 col-md-6">
                                <label class="form-label" for="attachment">Attach Image <span class="text-warning">(png, jpg, jpeg)</span></label>
                                <input type="file" name="attachment[]" id="attachment" class="form-control" multiple />
                            </div>
                            <div class="mb-1 col-md-12">
                                <div class="row">
                                    <div class="col-12">
                                    <label class="form-label" for="attachment1">Attach Documents <span class="text-warning">(pdf, word)</span></label>
                                    </div>
                                    <!-- <div class="col-8 mb-3 "> -->
                                        <div class="col-md-10 ">
                                        <!-- <label class="form-label" for="attachment">Attach Documents <span class="text-warning">(pdf)</span></label> -->
                                         <input type="file" name="attachment1[]" id="attachment1" class="form-control" multiple />
                                            </div> 
                                            <div class="col-md-2 ">
                                                <button type="button" class=" property-btn extraTicketAttachment ms-0">
                                                    <i data-feather="plus" class="align-middle ms-sm-25 ms-0"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div id="fileUploadsContainer"></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn--primary text-white btn-next">
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
    <input type="hidden" id="plan-url" value="{{ route('user.loan.plan') }}">
@endsection



@push('script')
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/forms/wizard/bs-stepper.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/forms/form-wizard.min.js') }}"></script>

    <script>
        function myFunction() {
            var plan_id = $("#gateway option:selected").attr('data-id');
            var name = $("#gateway option:selected").attr('data-name');
            var duration = $("#gateway option:selected").attr('data-duration');
            var percent_charge = $("#gateway option:selected").attr('data-percent_charge');
            var method_code = $("#gateway option:selected").attr('data-id');
            var min_amount = $("#gateway option:selected").attr('data-min_amount');
            var max_amount = $("#gateway option:selected").attr('data-max_amount');
            var image = $("#gateway option:selected").attr('data-image');
            document.getElementById("pcharge").value = percent_charge + "%";
            document.getElementById("min").value = min_amount;
            document.getElementById("max").value = max_amount;
            document.getElementById("duration").value = duration + " Months";
            document.getElementById("method_code").value = method_code;

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
   
        var fileAdded = 0;
        $('.extraTicketAttachment').on('click', function () {
            if (fileAdded >= 7) {
                notify('error', 'You\'ve added maximum number of documents');
                return false;
            }
            fileAdded++;
            $("#fileUploadsContainer").append(`
            <div class="row">
                                    <div class="col-12">
                                    <label class="form-label" for="attachment">Attach Documents <span class="text-warning">(pdf)</span></label>
                                    </div>
                                    <!-- <div class="col-8 mb-3 "> -->
                                        <div class="col-md-10 ">
                                        <!-- <label class="form-label" for="attachment">Attach Documents <span class="text-warning">(pdf)</span></label> -->
                                         <input type="file" name="attachment1[]" id="attachment1" class="form-control" multiple />
                                            </div> 
                                            <div class="col-md-2 ">
                                                <button type="button" class="h1 property-btn extraTicketAttachmentDelete ms-0">
                                                   -
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                `)
        });

        $(document).on('click', '.extraTicketAttachmentDelete', function () {
            fileAdded--;
            $(this).closest('.row').remove();
        });

    </script>
@endpush
