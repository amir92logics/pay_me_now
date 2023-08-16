@extends('admin.layouts.app')

@section('panel')
<div class="card">
    <div class="card-header">
        <h4 class="text-primary">Update bank</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.banks.update', $bank->id) }}" method="post" class="ajaxform_instant_reload">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-sm-6 mb-1">
                    <label for="name">BANK NAME</label>
                    <input type="text" name="name" value="{{ $bank->name }}" id="name" placeholder="Enter bank name" class="form-control" required>
                </div>
                <div class="col-sm-6 mb-1">
                    <label for="account_name">ACCOUNT NAME</label>
                    <input type="text" name="account_name" value="{{ $bank->account_name }}" id="account_name" placeholder="Enter account name" class="form-control" required>
                </div>
                <div class="col-sm-6 mb-1">
                    <label for="charge">CHARGE</label>
                    <input type="text" name="charge" value="{{ $bank->charge }}" id="charge" placeholder="Enter short code" class="form-control">
                </div>
                <div class="col-sm-6 mb-1">
                    <label for="account_no">ACCOUNT NUMBER</label>
                    <input type="text" name="account_no" value="{{ $bank->account_no }}" id="account_no" placeholder="Enter account number" class="form-control" required>
                </div>
                <div class="col-sm-6 mb-1">
                    <label for="code">SORT CODE</label>
                    <input type="text" name="code" value="{{ $bank->code }}" id="code" placeholder="Enter short code" class="form-control">
                </div>
                <div class="col-sm-12 mb-1">
                    <label for="description">DESCRIPTION</label>
                    <textarea name="description" id="description" placeholder="Enter description" class="form-control">{{ $bank->description }}</textarea>
                </div>
                <div class="col-12 text-end">
                    <button class="btn btn-primary btn-sm submit-btn"><i data-feather='save'></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
@endsection
