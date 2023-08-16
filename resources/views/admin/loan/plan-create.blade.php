@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="text-primary">{{ __('Create new plan') }}</h4>
                    <a href="{{ route('admin.loan.index') }}" class="btn btn-sm btn-primary"><i data-feather='list'></i>
                        @lang('View List')</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.loan.create') }}" method="POST" class="ajaxform_instant_reload">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="name">@lang('Name')</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  mb-1">
                                    <label for="min_amount">@lang('Minimum Amount')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="min" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" id="min" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="max_amount">@lang('Maximum Amount')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="max" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" id="max" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="total_return">@lang('Loan Duration') <small>(Months)</small></label>
                                    <div class="input-group">
                                        <input type="number" id="total_return" class="form-control" name="duration" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="penalty">@lang('Loan Penalty') <span>%</span></label>
                                    <select name="penalty" id="penalty" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="interest">@lang('Interest Amount') <span id="change_interest_symbol">%</span></label>
                                    <div class="input-group">
                                        <input type="number" step="any" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="interest" id="interest" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header text-center" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            {{ __('Add dynamic field') }} <i data-feather='arrow-down-circle'></i>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <h5 class="card-header bg-light">@lang('Dynamic Input Fields')
                                                        <button type="button" class="btn btn-sm btn-primary float-right addUserData">
                                                            <i data-feather='plus'></i> @lang('Add New')
                                                        </button>
                                                    </h5>

                                                    <div class="card-body">
                                                        <div class="row addedField">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-right text-end">
                                <button type="submit" class="btn btn-primary submit-btn"><i data-feather='save'></i>
                                    @lang('Save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {

            $('#interest_type').on('change', (e) => {
                var $this = e.currentTarget;

                var result = null;

                if ($this.value == 0) {
                    result = '{{ __($general->cur_text) }}';
                } else {
                    result = '%';
                }

                $('#change_interest_symbol').text(result);

            });

            $('#edit_interest_type').on('change', (e) => {
                var $this = e.currentTarget;

                var result = null;

                if ($this.value == 0) {
                    result = '{{ __($general->cur_text) }}';
                } else {
                    result = '%';
                }

                $('#update_interest_symbol').text(result);

            });

        })(jQuery);
    </script>

    <script>
        (function($) {
            "use strict";
            $('input[name=currency]').on('input', function() {
                $('.currency_symbol').text($(this).val());
            });
            $('.addUserData').on('click', function() {
                var html = `
                <div class="col-md-12 user-data">
                <br>
                    <div class="form-group">
                        <div class="input-group mb-md-0 mb-4">
                            <div class="col-md-4">
                                <input name="field_name[]" class="form-control" type="text" required placeholder="@lang('Field Name')">
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="type[]" class="form-control">
                                    <option value="text"> @lang('Input Text') </option>
                                    <option value="file"> @lang('file') </option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-md-0 mt-2">
                                <select name="validation[]"
                                        class="form-control">
                                    <option value="required"> @lang('Required') </option>
                                    <option value="nullable">  @lang('Optional') </option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-md-0 mt-2 text-right">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger btn-lg removeBtn w-100" type="button">
                                        Remove
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>`;

                $('.addedField').append(html);
            });

            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.user-data').remove();
            });
            @if (old('currency'))
                $('input[name=currency]').trigger('input');
            @endif
        })(jQuery);
    </script>
@endpush
