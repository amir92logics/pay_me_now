@extends($activeTemplate . 'layouts.dashboard')
@section('content')
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('All Withdrawals') }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('#')</th>
                                <th>@lang('Method')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Time')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($withdraws as $k=>$data)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ __(optional($data->method)->name) }}</td>
                                    <td>
                                        <strong>{{ showAmount($data->amount) }}</strong>
                                    </td>
                                    <td>
                                        {{ showAmount($data->charge) }}
                                    </td>
                                    <td>
                                        @if ($data->status == 'approved')
                                            <span class="badge rounded-pill bg-primary me-1"><i data-feather='check-circle'></i> @lang('Complete')</span>
                                        @elseif($data->status == 'pending')
                                            <span class="badge rounded-pill bg-warning me-1"><i data-feather='alert-circle'></i> @lang('Pending')</span>
                                        @elseif($data->status == 'rejected')
                                            <span class="badge rounded-pill bg-danger me-1"><i data-feather='x'></i> @lang('Rejected')</span>
                                        @endif

                                    </td>
                                    <td>
                                        {{ showDateTime($data->created_at) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">{{ __("No data available") }}</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                {{ $withdraws->links() }}
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
@endsection
