@extends('admin.layouts.app')

@section('panel')
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="btn-group p-1" role="group" aria-label="Basic example">
                    <a class="btn btn-primary btn-sm {{ request()->is('*/withdraw') && !request('status') ? 'active' : '' }}"
                        href="{{ route('admin.withdraw.index') }}">@lang('All')
                        <span class="badge badge-sm rounded-circle bg-light text-dark">{{ $total_payouts }}</span></a>
                    <a class="btn btn-primary btn-sm {{ request('status') == 'approved' ? 'active' : '' }}"
                        href="{{ route('admin.withdraw.index', ['status' => 'approved']) }}">{{ __('Approved') }}
                        <span class="badge badge-sm rounded-circle bg-success">{{ $total_approved }}</span></a>
                    <a class="btn btn-primary btn-sm {{ request('status') == 'pending' ? 'active' : '' }}"
                        href="{{ route('admin.withdraw.index', ['status' => 'pending']) }}">{{ __('Pending') }}
                        <span class="badge badge-sm rounded-circle bg-warning">{{ $total_pending }}</span></a>
                    <a class="btn btn-primary btn-sm {{ request('status') == 'rejected' ? 'active' : '' }}"
                        href="{{ route('admin.withdraw.index', ['status' => 'rejected']) }}"> {{ __('Rejected') }}
                        <span class="badge badge-sm rounded-circle bg-danger">{{ $total_rejected }}</span></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Method') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraws as $payout)
                                <tr id="row4">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ optional($payout->method)->name }}</td>
                                    <td>{{ date('d M y H:i A', strtotime($payout->created_at)) }}</td>
                                    <td>{{ $general->cur_sym . $payout->amount }}</td>
                                    <td>
                                        @if ($payout->status == 'pending')
                                            <span class="badge bg-warning">{{ __('Pending') }}</span>
                                        @elseif ($payout->status == 'rejected')
                                            <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                        @elseif ($payout->status == 'approved')
                                            <span class="badge bg-success">{{ __('Approved') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm rounded-pill" href="{{ route('admin.withdraw.show', $payout->id) }}">
                                            <i data-feather='eye'></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{ paginateLinks($withdraws) }}
        </div><!-- card end -->
    </div>
@endsection
