@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-between">
                <h4>Create Loan Plants</h4>
                <a href="{{ route('admin.plan.index') }}"
                    class="btn btn-sm btn--primary box--shadow1 text-white text--small addBtn"><i
                        class="fa fa-fw fa-plus"></i>@lang('Back TO loan Plan')</a>
            </div>

            <hr>
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <form action="{{ route('admin.loan.plan.post') }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" required>

                        <div class="modal-body">

                            <div class="row">
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Title')</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Interest Type')</label>
                                    <select name="interest_type" class="form-control">
                                        <option value="">select</option>
                                        <option value="1" {{ old('interest_type') == '1' ? 'selectd' : '' }}>fixed
                                        </option>
                                        <option value="2" {{ old('interest_type') == '2' ? 'selectd' : '' }}>percentage
                                        </option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('interest_type') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Loan Type')</label>
                                    <select name="loan_type" class="form-control">
                                        <option value="">select</option>
                                        <option value="one time" {{ old('loan_type') == 'one time' ? 'selectd' : '' }}>one
                                            time</option>
                                        <option value="weakly" {{ old('loan_type') == 'weakly' ? 'selectd' : '' }}>weakly
                                        </option>
                                        <option value="monthly" {{ old('loan_type') == 'monthly' ? 'selectd' : '' }}>monthly
                                        </option>
                                        <option value="yearly" {{ old('loan_type') == 'yearly' ? 'selectd' : '' }}>yearly
                                        </option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('loan_type') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Interest')</label>
                                    <input type="number" name="interest" value="{{ old('interest') }}"
                                        class="form-control">
                                    <span class="text-danger">{{ $errors->first('interest') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Minimum')</label>
                                    <input type="number" name="min" value="{{ old('min') }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('min') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Maximum')</label>
                                    <input type="number" name="max" value="{{ old('max') }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('max') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Late fees Type')</label>
                                    <select name="late_fees_type" class="form-control">
                                        <option value="">select</option>
                                        <option value="1" {{ old('late_fees_type') == '1' ? 'selectd' : '' }}>fixed
                                        </option>
                                        <option value="2" {{ old('late_fees_type') == '2' ? 'selectd' : '' }}>
                                            percentage</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('late_fees_type') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Late fees')</label>
                                    <input type="number" name="late_fees" value="{{ old('late_fees') }}"
                                        class="form-control">
                                    <span class="text-danger">{{ $errors->first('late_fees') }}</span>
                                </div>
                                <div class="col-12 col-md-6 py-2">
                                    <label for="edit_name">@lang('Data')</label>
                                    <input type="number" name="data" value="{{ old('data') }}" class="form-control">
                                    <span class="text-danger">{{ $errors->first('data') }}</span>
                                </div>
                                <div class="col-12 py-2 text-center">
                                    <button class="btn btn-primary" type="submit">Create</button>
                                </div>

                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
