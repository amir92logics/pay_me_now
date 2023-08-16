@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-4 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mb-20 text-primary">@lang('Fund Transfer')</h4>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.transfers.index') }}">Back <i data-feather='arrow-right'></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> @lang('Date')</th>
                                <th> @lang('Sender')</th>
                                <th> @lang('Amont')</th>
                                <th> @lang('Trx Number')</th>
                                <th> @lang('Charge')</th>
                                <th> @lang('Beneficiary')</th>
                                <th> @lang('Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>{{ showDateTime($log->created_at) }}</td>
                            <td>{{ $log->sender ? $log->sender->username : '' }} </td>
                            <td>{{ $log->amount }} </td>
                            <td>{{ $log->trx }}</td>
                            <td>{{ $log->charge }} </td>
                            <td>
                                @if ($log->is_beneficiary == '1')
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                @if ($log->status == 0)
                                    <span class="badge badge-pill bg-warning">@lang('Pending')</span>
                                @elseif($log->status == 1)
                                    <span class="badge badge-pill bg-success">@lang('Approved')</span>
                                @elseif($log->status == 2)
                                    <span class="badge badge-pill bg-danger">@lang('Rejected')</span>
                                @endif
                            </td>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
