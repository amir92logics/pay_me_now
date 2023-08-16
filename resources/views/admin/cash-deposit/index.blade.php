@extends('admin.layouts.app')

@section('panel')
    <div class="col-md-12">
        <div class="card b-radius--10">
            <div class="card-header">
                <h4>{{ __('Cash deposit settings') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.cash-deposit.store') }}" method="POST" class="ajaxform" method="post">
                    @csrf

                    <textarea required name="cash_deposit" id="summernote" cols="30" rows="10" class="form-control" placeholder="Please enter cash deposit address">{{ $cash_deposite }}</textarea>

                    <div class="py-1 text-end">
                        <button class="btn btn-primary submit-btn w-100 mt-1" type="submit"><i data-feather='save'></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
