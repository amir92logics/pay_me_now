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
                    @lang('Your Sub Savings Accounts').
                </p>
            </div>
            <div class="table-responsive">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>@lang('Account')</th>
                            <th>@lang('Balance')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accounts as $account)
                        <tr>
                            <td data-label="#@lang('Trx')">{{$account->name}}<br>
                                <small>{{showDateTime($account->created_at)}}</small>
                            </td>
                            <td data-label="@lang('Balance')" class="text-primary">
                                <strong>{{showAmount($account->amount)}} {{__($general->cur_text)}}</strong>
                            </td>
                            <td data-label="@lang('Status')">
                                @if($account->status == 1)
                                <span class="badge rounded-pill badge-light-primary me-1">@lang('Enabled')</span>
                                @elseif($account->status == 0)
                                <span class="badge rounded-pill badge-light-danger me-1">@lang('Disabled')</span>
                                @endif
                            </td>
                            <td data-label="@lang('Record')">
                                <a class="btn btn-sm btn-primary" href="{{ route('user.subsaving.show',$account->id) }}">Show</a>
                                @if ($account->status == 1)
                                <button data-bs-toggle="modal" href="#trxModal" onclick="openTrxModal('{{$account->id}}')" class="btn btn-sm btn-success">Transfer</button>
                                @endif
                                <a class="btn btn-sm btn-warning" href="{{ route('user.subsaving.edit',$account->id) }}">Edit</a>
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

{{-- Add Sub Balance MODAL --}}
<div id="trxModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Transfer Balance')</h5>

            </div>
            <form action="{{route('user.subsaving.trx')}}" method="POST">
                @csrf
                <input type="hidden" name="account" id="accountId">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-check form-switch form-check-primary mb-1">
                                <input type="checkbox" class="form-check-input" name="act" id="customSwitch10" checked />
                                <label class="form-check-label" for="customSwitch10">
                                    <span class="switch-icon-left"><i data-feather="plus"></i></span>
                                    <span class="switch-icon-right"><i data-feather="minus"></i></span>
                                </label>
                            </div>
                            <small>Check toggle to credit and uncheck toggle to debit</small><br>
                            <small>Your Main Account Balance is {{showAmount(auth_user()->balance)}} {{__($general->cur_text)}}</small><br>
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
<script>
    function openTrxModal(accountId) {
        document.getElementById('accountId').value = accountId;
    }
</script>
@endpush