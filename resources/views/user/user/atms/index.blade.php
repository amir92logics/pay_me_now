@extends($activeTemplate.'layouts.dashboard')
@section('content')
<!-- Basic Tables start -->
@push('style')
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
<!-- END: Vendor CSS-->
@endpush
<!-- Basic table -->
<div class="row" id="basic-datatable">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$pageTitle}}</h4>
            </div>
            <div class="card-body">
                <p class="card-text">
                    @lang('Atm Locations').
                </p>
            </div>
            <div class="table-responsive">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Address')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($atms as $atm)
                        <tr>
                            <td data-label="#@lang('Name')">{{$atm->name}}<br>
                            </td>
                            <td data-label="@lang('Address')" class="text-primary">
                                <strong>{{$atm->address}}</strong>
                            </td>
                            <td data-label="@lang('Action')">
                                <a class="btn btn-sm btn-primary" href="{{ route('user.atms.show',$atm->id) }}">View Map</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%">{{ __($emptyMessage) }}</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- Basic Tables end -->

@endsection


@push('script')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>

<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/tables/table-datatables-basic.min.js')}}"></script>

@endpush