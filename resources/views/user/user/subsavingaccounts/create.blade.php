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
<form action="{{route('user.subsaving.store')}}" method="post">
    @csrf
    <section class="horizontal-wizard">
        <div class="bs-stepper horizontal-wizard-example">
            <div class="bs-stepper-content">
                <div id="account-details" class="" role="tabpanel" aria-labelledby="account-details-trigger">
                    <div class="content-header mb-1">
                        <h5 class="">New Liquid Cash Account</h5>
                        <!-- <small class="text-muted"></small> -->
                    </div>
                    <div class="row">

<div class="mb-1 col-md-12">
<div class="alert alert-warning" role="alert">
  <div class="alert-body"><strong>Note!</strong>Please note that you can create only 3 subsaving accounts...</div>
</div>
</div>


                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="name">Account Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Account Name" />
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="amount">Transfer Amount</label>
                            <input type="number" name="amount" id="amount" min="0.00" step="0.01" class="form-control" placeholder="0.00" />
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