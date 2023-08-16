@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-4 mb-30 m-auto">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-header">
                    <h4 class="text-primary">User Funds Transfers</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> @lang('SL')</th>
                                <th> @lang('Sernder User') </th>
                                <th> @lang('Email')</th>
                                <th> @lang('Amount') </th>
                                <th> @lang('Trx') </th>
                                <th> @lang('Charge') </th>
                                <th> @lang('Beneficiary')</th>
                                <th> @lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($log as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{ $item->sender ? $item->sender->username : '' }}</td>
                                    <td> {{ $item->email }}</td>
                                    <td>{{ $item->amount }} </td>
                                    <td>{{ $item->trx }} </td>
                                    <td>{{ $item->charge }} </td>

                                    <td>
                                        @if ($item->is_beneficiary == '1')
                                            <span class="badge bg-success  font-weight-bold">Yes</span>
                                        @else
                                            <span class="badge bg-danger  font-weight-bold">No</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.transfers.show', $item->id) }}"
                                            class="badge bg-info text-white">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="py-3 d-flex justify-content-center">
                        {{ $log->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
