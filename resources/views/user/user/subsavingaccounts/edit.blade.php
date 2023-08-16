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
<form action="{{route('user.subsaving.update', $subSavingAccount->id)}}" method="post">
    @csrf
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-example">
            <div class="bs-stepper-content">
                <div id="account-details" class="" role="tabpanel" aria-labelledby="account-details-trigger">
                    <div class="content-header mb-1">
                        <h5 class="">Your Sub Saving Account is
                            @if($subSavingAccount->status == 1)
                            <span class="badge rounded-pill badge-light-success me-1">@lang('Enabled')</span>
                            @elseif($subSavingAccount->status == 0)
                            <span class="badge rounded-pill badge-light-danger me-1">@lang('Disabled')</span>
                            @endif
                        </h5>
                        <!-- <small class="text-muted"></small> -->
                    </div>

                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="name">Account Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Account Name" value="{{ $subSavingAccount->name }}" required />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="status">Status</label><br>
                            <select class="form-control" name="status" id="status">
                                <option @if ($subSavingAccount->status == 1) {{ "selected" }} @endif value="1">@lang('Enable')</option>
                                <option @if ($subSavingAccount->status == 0) {{ "selected" }} @endif value="0">@lang('Disable')</option>
                            </select>
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

@endsection



@push('script')
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/forms/form-wizard.min.js')}}"></script>

@endpush