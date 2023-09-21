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
                    @lang('Your Liquid Cashs Transaction Log').
                </p>
            </div>
            <div class="table-responsive">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>@lang('Trx')</th>
                            <th>@lang('Trx Type')</th>
                            <th>@lang('Balance')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Charges')</th>
                            <th>@lang('Post Balance')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                        <tr>
                            <td data-label="#@lang('Trx')">{{$transaction->trx}}<br>
                                <small>{{showDateTime($transaction->created_at)}}</small>
                            </td>
                            <td data-label="@lang('Trx Type')">
                                @if($transaction->trx_type == 1)
                                <span class="badge rounded-pill badge-light-primary me-1">@lang('Credit')</span>
                                @elseif($transaction->trx_type == 0)
                                <span class="badge rounded-pill badge-light-danger me-1">@lang('Debit')</span>
                                @endif
                            </td>
                            <td data-label="@lang('Balance')" class="text-primary">
                                <strong>{{showAmount($transaction->initial_balance)}} {{__($general->cur_text)}}</strong>
                            </td>
                            <td data-label="@lang('Amount')" class="text-primary">
                                <strong>{{showAmount($transaction->amount)}} {{__($general->cur_text)}}</strong>
                            </td>
                            <td data-label="@lang('Charges')" class="text-primary">
                                <strong>{{showAmount($transaction->charge)}} {{__($general->cur_text)}}</strong>
                            </td>
                            <td data-label="@lang('Post Balance')" class="text-primary">
                                @if ($transaction->trx_type == 1)
                                <strong>{{showAmount($transaction->initial_balance+$transaction->amount)}} {{__($general->cur_text)}}</strong>
                                @elseif($transaction->trx_type == 0)
                                <strong>{{showAmount($transaction->initial_balance-$transaction->amount)}} {{__($general->cur_text)}}</strong>
                                @endif

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
            {{ $transactions->links() }}
        </div>
    </div>
</div>
<!-- Basic Tables end -->

{{-- Add Sub Balance MODAL --}}
<div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add / Subtract Balance')</h5>

            </div>
            <form action="{{route('user.subsaving.trx')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-check form-switch form-check-primary">
                                <input type="checkbox" class="form-check-input" name="act" id="customSwitch10" checked />
                                <label class="form-check-label" for="customSwitch10">
                                    <span class="switch-icon-left"><i data-feather="plus"></i></span>
                                    <span class="switch-icon-right"><i data-feather="minus"></i></span>
                                </label>
                            </div>
                            <small>Check toggle to credit and uncheck toggle to debit</small><br>


                        </div>


                        <div class="form-group col-md-12">
                            <label>@lang('Amount')<span class="text-danger">*</span></label>
                            <div class="input-group has_append">
                                <input type="text" name="amount" class="form-control" placeholder="@lang('Please provide positive amount')">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-success">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('script')
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>

<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/tables/table-datatables-basic.min.js')}}"></script>

@endpush