@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="text-primary">{{ __("Saving plans list.") }}</h4>
                    <a href="{{ route('admin.savings.savingPlan') }}" class="btn btn-sm btn-primary"><i data-feather='arrow-left'></i> @lang('Back')</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.savings.update', $plan->id) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="name">@lang('Name')</label>
                                    <input type="text" name="name" class="form-control" id="name" required value="{{ $plan->name }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  mb-1">
                                    <label for="min_amount">@lang('Minimum Amount')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="min" id="min" class="form-control" required value="{{ $plan->min }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="max_amount">@lang('Maximum Amount')</label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="max" id="max" class="form-control" required value="{{ $plan->max }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-1">
                                    <label for="total_return">@lang('Loan Duration') <small>(Months)</small></label>
                                    <div class="input-group">
                                        <input type="number" id="total_return" class="form-control" name="duration" required value="{{ $plan->duration }}">
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
            "use strict";
            $('input[name=currency]').on('input', function() {
                $('.currency_symbol').text($(this).val());
            });
          
            @if (old('currency'))
                $('input[name=currency]').trigger('input');
            @endif
        })(jQuery);
    </script>
@endpush
