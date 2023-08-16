@extends('admin.layouts.app')

@section('panel')
<div class="col-md-12">
    <div class="card b-radius--10">
        <div class="card-header justify-content-between py-1">
            <div class="col">
                <h4 class="text-primary">{{ __($pageTitle) }}</h4>
            </div>
            <div class="col-8 col-sm-4">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" id="basic-default-password" placeholder="Search...." aria-describedby="basic-default-password">
                        <button class="input-group-text cursor-pointer btn btn-primary"><i data-feather='search'></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive--sm table-responsive">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th>@lang('#')</th>
                            <th>@lang('Trx')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Created At')</th>
                            <th>@lang('Deposit Type')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deposits as $deposit)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $deposit->trx }}</td>
                                <td>{{ $deposit->amount }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($deposit->created_at)) }}</td>
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
                                <td>
                                    <a href="{{ route('admin.deposits.show', $deposit->id) }}" class="btn btn-primary btn-sm"> <i data-feather='eye'></i> {{ __('View') }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __('Data not available') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table><!-- table end -->
            </div>
        </div>
        {{ paginateLinks($deposits) }}
    </div><!-- card end -->
    <br>
</div>
@endsection
