@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-4 mb-30 m-auto">
            <div class="card b-radius--10 overflow-hidden box--shadow1 pb-4">
                <div class="card-header">
                    <h4 class="text-primary">Withdraw Details</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> @lang('Date')</th>
                                <th> @lang('User Name') </th>
                                <th> @lang('Methods')</th>
                                <th> @lang('Amount') </th>
                                <th> @lang('Charge')</th>
                                <th> @lang('Status')</th>
                                <th> @lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ showDateTime($withdrawal->created_at) }}</td>
                                <td> {{ $withdrawal->user ? $withdrawal->user->username : '' }}</td>
                                <td> {{ $withdrawal->method ? $withdrawal->method->name : '' }}</td>
                                <td>${{ $withdrawal->amount }} </td>
                                <td>${{ $withdrawal->charge }}</td>

                                <td>
                                    @if ($withdrawal->status == 'pending')
                                        <span class="badge bg-primary  font-weight-bold">{{ $withdrawal->status }}</span>
                                    @elseif ($withdrawal->status == 'approved')
                                        <span class="badge bg-success  font-weight-bold">{{ $withdrawal->status }}</span>
                                    @elseif ($withdrawal->status == 'rejected')
                                        <span class="badge bg-danger  font-weight-bold">{{ $withdrawal->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($withdrawal->status != 'approved')
                                    <a href="{{ route('admin.withdraw.approved', ['payout' => $withdrawal->id]) }}" class="badge bg-info text-white"> <i data-feather='check-circle'></i> Approved</a>
                                    @endif
                                    @if ($withdrawal->status != 'rejected')
                                    <a href="{{ route('admin.withdraw.reject', ['payout' => $withdrawal->id]) }}" class="badge bg-danger text-white"> <i data-feather='x-circle'></i> Reject</a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1 pb-4">
                <div class="card-header">
                    <h4 class="text-primary">Withdraw method information</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th> @lang('Name')</th>
                                <td>{{ $withdrawal->method->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Min Limit')</th>
                                <td>{{ $withdrawal->method->min_limit ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Max Limit') </th>
                                <td>{{ $withdrawal->method->max_limit ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Delay')</th>
                                <td>{{ $withdrawal->method->delay ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Fixed Charge')</th>
                                <td>{{ $withdrawal->method->fixed_charge ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Charge Type')</th>
                                <td>{{ $withdrawal->method->charge_type ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Rate')</th>
                                <td>{{ $withdrawal->method->rate ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Percent Charge')</th>
                                <td>{{ $withdrawal->method->percent_charge ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Currency')</th>
                                <td>{{ $withdrawal->method->currency ?? '' }}</td>
                            </tr>
                            <tr>
                                <th> @lang('Description')</th>
                                <td>{{ $withdrawal->method->description ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1 pb-4">
                <div class="card-header">
                    <h4 class="text-primary">Account infos</h4>
                </div>
                @php
                    $fields = $withdrawal->method->user_data;
                    $datas = $usermethod->withdraw_infos;
                @endphp
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>{{ __('Available Balance') }}</th>
                                <td>${{ $withdrawal->user->balance ?? '' }}</td>
                            </tr>
                            @foreach ($fields as $key => $field)
                            <tr>
                                <th>{{ $field->field_level ?? '' }}</th>
                                <td>{{ $datas[$key] ?? '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
