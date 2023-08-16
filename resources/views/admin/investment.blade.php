@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('Plan')</th>
                                <th>@lang('User')</th>
                                <th>@lang('Return')</th>
                                <th>@lang('Interest Amount')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Invested')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($investments as $data)
                            <tr>
                                <td data-label="@lang('Plan')">
                                    <span class="font-weight-bold" data-toggle="tooltip" data-original-title="@lang('Plan Name')">
                                        <a href="{{ route('admin.plan.index') }}">{{ $data->plan->name }}</a>
                                    </span>
                                    <br/>
                                    <span class="font-weight-bold" data-toggle="tooltip" data-original-title="@lang('Transaction Number')">
                                        {{ $data->trx }}
                                    </span>
                                </td>
                                <td data-label="@lang('User')">
                                    <span class="font-weight-bold">{{$data->user->fullname}}</span>
                                        <br>
                                    <span class="small">
                                        <a href="{{ route('admin.users.detail', $data->user_id) }}"><span>@</span>{{ $data->user->username }}
                                        </a>
                                    </span>
                                </td>

                                <td data-label="@lang('Return')">
                                    <span class="font-weight-bold" data-toggle="tooltip" data-original-title="@lang('Transaction Number')">
                                        @lang('Total') {{ $data->total_return }} @lang('Times')
                                    </span>
                                    <br>
                                    <span class="font-weight-bold" data-toggle="tooltip" data-original-title="@lang('Transaction Number')">
                                        @lang('Paid') {{ $data->total_paid }} @lang('Times')
                                    </span>
                                </td>

                                <td data-label="@lang('Interest Amount')">
                                    {{ showAmount($data->interest_amount) }}
                                    {{ __($general->cur_text) }}
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($data->status == 0)
                                        <span class="badge bg-primary">
                                            @lang('Running')
                                        </span>
                                    @elseif($data->status == 1)
                                    <span class="badge bg-success">
                                        @lang('Completed')
                                    </span>
                                    @endif
                                </td>

                                <td data-label="@lang('Invested')">
                                    {{ showDateTime($data->created_at) }} <br> {{ diffForHumans($data->created_at) }}
                                </td>

                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($investments) }}
                </div>
            </div>
        </div>

    </div>


@endsection
