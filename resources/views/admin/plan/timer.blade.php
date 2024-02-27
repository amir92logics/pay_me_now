@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
         <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text-white text--small addBtn"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
         <hr>
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Time')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($timer as $data)
                            <tr>
                                <td data-label="@lang('Name')">
                                    <span class="font-weight-bold">
                                        {{ __($data->name) }}
                                    </span>
                                </td>


                                <td data-label="@lang('Months')">
                                    {{ $data->time }} Months
                                </td>

                                <td data-label="@lang('Action')">
                                    <a href="#0"

                                    data-id='{{ $data->id }}'
                                    data-name='{{ $data->name }}'
                                    data-timer='{{ $data->time }}'
                                    data-slug='{{ $data->slug }}'
                                    class="btn btn-sm btn--primary text-white icon-btn editBtn"
                                    data-toggle="tooltip"
                                    title="@lang('Edit')"
                                    data-original-title="@lang('Edit')"
                                    >
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
                    {{ paginateLinks($timer) }}
                </div>
            </div>
        </div>

    </div>

{{-- ADD METHOD MODAL --}}
<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add New Timer')</h5>

            </div>
            <form action="{{ route('admin.timer.create') }}" method="POST">
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-1">
                                <label for="name">@lang('Name')</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>



                        <div class="col-lg-12">
                            <div class="form-group mb-1">
                                <label for="interest">@lang('Slug') </label>
                                <div class="input-group">
                                    <input type="text" name="slug" class="form-control" required>

                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="form-group mb-1">
                                <label for="interest">@lang('Months') </label>
                                <div class="input-group">
                                    <input type="text" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="timer" class="form-control" required>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary text-white">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT METHOD MODAL --}}
<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Edit Plan')</h5>

            </div>
            <form action="{{ route('admin.timer.edit') }}" method="POST">
                @csrf

                <input type="hidden" name="id" required>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-1">
                                <label for="edit_name">@lang('Name')</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-1">
                                <label for="edit_total_return">@lang('Slug')</label>
                                <div class="input-group">
                                    <input type="text" id="slug" class="form-control" name="slug" required>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-1">
                                <label for="edit_interest">@lang('Months')</label>
                                <div class="input-group">
                                    <input type="text" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="timer" id="timer" class="form-control" required>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn text-white btn--primary">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    (function ($) {

        "use strict";

        $('.addBtn').on('click', (e)=> {
            var modal = $('#addModal');
            modal.modal('show');
        });



        $('.editBtn').on('click', (e)=> {
            var $this = $(e.currentTarget);
            var modal = $('#editModal');

            var result = null;

            modal.find('input[name=id]').val($this.data('id'));
            modal.find('input[name=name]').val($this.data('name'));
            modal.find('input[name=slug]').val($this.data('slug'));
            modal.find('input[name=timer]').val($this.data('timer'));
            modal.modal('show');
        });

    })(jQuery);

</script>
@endpush
