@extends('admin.layouts.app')

@section('panel')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body mb-0 pb-0">
                <div class="row justify-content-between py-1">
                    <div class="col">
                        <h4>Banks</h4>
                    </div>
                    <div class="col text-end">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.banks.create') }}"><i
                                data-feather='plus-circle'></i> {{ __('Create new') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive--md  table-responsive">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>BANK NAME</th>
                            <th>ACCOUNT NAME</th>
                            <th>CHARGE</th>
                            <th>ACCOUNT NUMBER</th>
                            <th>SORT CODE</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks as $bank)
                        <tr>
                            <td>{{ $bank->id }}</td>
                            <td>{{ $bank->name }}</td>
                            <td>{{ $bank->account_name }}</td>
                            <td>{{ $bank->charge }}</td>
                            <td>{{ $bank->account_no }}</td>
                            <td>{{ $bank->code }}</td>
                            <td data-label="Action">
                                <form action="{{ route('admin.banks.destroy', $bank->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <div class="btn-group">
                                        <a href="{{ route('admin.banks.edit', $bank->id) }}" class="btn btn-sm btn-primary">
                                            <i data-feather='edit'></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger">
                                            <i data-feather='trash'></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!-- table end -->
            </div>
        </div>
    </div>
    <br>
@endsection
