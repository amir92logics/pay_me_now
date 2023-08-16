@extends($activeTemplate.'layouts.dashboard')

@section('content')
    <div class="col-md-12">
        <div class="card b-radius--10">
            <div class="card-header justify-content-between py-1">
                <div class="col">
                    <a class="btn btn-primary btn-sm" href="{{ route('user.deposits.index') }}">
                        <i data-feather='arrow-left'></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Trx')</th>
                                @if ($deposit->type == 'bank_transfer')
                                <th>@lang('Bank Name')</th>
                                <th>@lang('Bank Account No')</th>
                                @endif
                                <th>@lang('Amount')</th>
                                <th>@lang('Created At')</th>
                                <th>@lang('Deposit Type')</th>
                                <th>@lang('Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $deposit->trx }}</td>
                                @if ($deposit->type == 'bank_transfer')
                                <td>{{ $deposit->meta['bank_name'] ?? '' }}</th>
                                <td>{{ $deposit->meta['account_no'] ?? '' }}</td>
                                @endif
                                <td>{{ $deposit->amount }}</td>
                                <td>{{ $deposit->created_at }}</td>
                                <td>
                                    @if ($deposit->type == "bank_transfer")
                                        <div class="badge bg-success">{{ __('Bank Transfer') }}</div>
                                    @elseif ($deposit->type == 'cash_deposit')
                                        <div class="badge bg-warning">{{ __('Cash Deposit') }}</div>
                                    @else
                                        <div class="badge bg-danger">{{ __("Cheque") }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($deposit->status == 1)
                                        <div class="badge bg-success">{{ __('Approved') }}</div>
                                    @elseif ($deposit->status == 2)
                                        <div class="badge bg-warning">{{ __('Pending') }}</div>
                                    @else
                                        <div class="badge bg-danger">{{ __("Rejected") }}</div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
            <div class="card-body">
                <h4 class="text-primary mb-3">User Informations</h4>
                <div class="row">
                    @if ($deposit->type == 'cheque')
                    <div class="col-sm-6">
                        <h6>Front Check</h6>
                        <a target="_blank" href="{{ asset($deposit->meta['front_cheque']) }}">
                            <img style="width: 100%; height: 100px" src="{{ asset('images/'.$deposit->meta['front_cheque']) }}" alt="">
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <h6>Back Check</h6>
                        <a target="_blank" href="{{ asset($deposit->meta['back_cheque']) }}">
                            <img style="width: 100%; height: 100px" src="{{ asset('images/'.$deposit->meta['back_cheque']) }}" alt="">
                        </a>
                    </div>
                    @elseif ($deposit->type == 'bank_transfer')
                    <div class="col-sm-6">
                        <h6>Notes: </h6>
                        <p>{{ $deposit->meta['notes'] }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h6>Proof</h6>
                        <a target="_blank" class="text-primary" href="{{ asset('images/'.$deposit->meta['proof'] ?? '') }}">
                            Preview <i data-feather='arrow-right-circle'></i>
                        </a>
                    </div>
                    @elseif ($deposit->type == 'cash_deposit')
                    <div class="col-12">
                        <p><b>Notes: </b> {{ $deposit->meta['notes'] }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div><!-- card end -->
        @if ($deposit->type == 'bank_transfer')
        <div class="card">
            <div class="card-body">
                <h4 class="text-primary mb-2">Bank Informations</h4>
                <div class="table-responsive--md  table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>BANK NAME</th>
                                <th>ACCOUNT NAME</th>
                                <th>CHARGE</th>
                                <th>ACCOUNT NUMBER</th>
                                <th>SORT CODE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $bank = App\Models\Bank::find($deposit->meta['bank_id'] ?? '');
                            @endphp
                            <tr>
                                <td>{{ $bank->name }}</td>
                                <td>{{ $bank->account_name }}</td>
                                <td>{{ $bank->charge }}</td>
                                <td>{{ $bank->account_no }}</td>
                                <td>{{ $bank->code }}</td>
                            </tr>
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>
        </div>
        @endif
        <br>
    </div>
@endsection
