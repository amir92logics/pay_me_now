@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="text-primary">{{ __("Saving plans list.") }}</h4>
                    <a href="{{ route('admin.savings.plan.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i><i data-feather='plus-circle'></i> @lang('Add New')</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Min-Max')</th>
                                <th>@lang('Duration')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($SavingPlan as $data)
                            <tr>
                                <td data-label="@lang('Name')">
                                    <span class="font-weight-bold">
                                        {{ __($data->name) }}
                                    </span>
                                </td>

                                <td data-label="@lang('Limit')">
                                    <span class="font-weight-bold" data-toggle="tooltip" data-original-title="@lang('Limitation of Amount')">
                                        {{ $general->cur_sym }} {{ showAmount($data->min) }} -
                                        {{ $general->cur_sym }} {{ showAmount($data->max) }}
                                    </span>
                                </td>

                                <td data-label="@lang('Total Return')">
                                    {{ $data->duration }} @lang('Months')
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($data->status == 0)
                                        <span class="badge bg-danger">
                                            @lang('Disabled')
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            @lang('Enabled')
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.savings.edit', $data->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($SavingPlan) }}
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
<script>
    (function ($) {
        $('#interest_type').on('change', (e)=>{
            var $this = e.currentTarget;

            var result = null;

            if($this.value == 0){
                result = '{{ __($general->cur_text) }}';
            }else{
                result = '%';
            }

            $('#change_interest_symbol').text(result);

        });

        $('#edit_interest_type').on('change', (e)=>{
            var $this = e.currentTarget;

            var result = null;

            if($this.value == 0){
                result = '{{ __($general->cur_text) }}';
            }else{
                result = '%';
            }

            $('#update_interest_symbol').text(result);

        });

    })(jQuery);

</script>
@endpush
