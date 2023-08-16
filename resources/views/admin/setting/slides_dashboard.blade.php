@extends('admin.layouts.app')
@section('panel')

<div>
    <div class=" mb-30">
        <div class="card">
            <div class="card-body" style="width: 50%;">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="avatar avatar-xl">
                                                <img src="{{ getImage(imagePath()['dashboardSlide']['path'].'/slide.png', '?'.time()) }}" alt="avatar" />

                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="form-control profilePicUpload" id="profilePicUpload1" accept=".png, .jpg, .jpeg" name="slide" multiple accept="image/*">
                                    <label for="profilePicUpload1" class="bg--primary">@lang('Select Image') </label>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <br>
            <button type="submit" class="btn btn--primary text-white btn-block" style="width: 10%; margin-bottom: 20px; margin-left: 20px;">@lang('Update')</button>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="javascript:void(0)" class="btn btn-sm btn--primary text-white box--shadow1 text--small addBtn waves-effect waves-float waves-light"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                <hr>
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two custom-data-table">
                        <thead>
                            <tr>
                                <th>@lang('SL')</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @forelse($slides as $slide)
                            <tr>
                                <td data-label="@lang('SL')">{{$loop->iteration}}</td>
                                <td data-label="@lang('Image')">
                                    <div class="customer-details d-block">
                                        <a href="javascript:void(0)" class="thumb">
                                            <img src="{{ getImage(imagePath()['dashboardSlide']['path'].'/'.$slide->path) }}" width="50" alt="@lang('image')">
                                        </a>
                                    </div>
                                </td>
                                <td data-label="@lang('Action')">
                                    <button class="btn btn-sm text-white updateBtn" data-id="{{$slide->id}}" data-all="">
                                        Edit
                                    </button>

                                    <button class="btn btn-danger btn-sm removeBtn" data-id="{{ $slide->id }}">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="addModal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add New Item')</h5>
            </div>
            <form action="{{ route('admin.dashboardslides.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-1">
                        <label for="addImage">@lang('Upload New Slide')</label>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" name="image" id="addImage" accept=".png, .jpg, .jpeg">
                                    <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png')</b>.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary text-white">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="updateModal" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add New Item')</h5>
            </div>
            <form action="{{ route('admin.dashboardslides.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="updateId">
                <div class="modal-body">
                    <div class="form-group mb-1">
                        <label for="addImage">@lang('Upload New Slide')</label>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" name="image" id="addImage" accept=".png, .jpg, .jpeg">
                                    <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png')</b>.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary text-white">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="removeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Confirmation')</h5>

            </div>
            <form action="{{ route('admin.dashboardslides.destroy') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p class="font-weight-bold">@lang('Are you sure to delete this item? Once deleted can not be undone.')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-danger">@lang('Remove')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('script')

<script>
    (function($) {
        "use strict";
        $('.removeBtn').on('click', function() {
            var modal = $('#removeModal');
            modal.find('input[name=id]').val($(this).data('id'))
            modal.modal('show');
        });

        $('.addBtn').on('click', function() {
            var modal = $('#addModal');
            modal.modal('show');
        });

        $('.updateBtn').on('click', function() {
            var modal = $('#updateModal');
            modal.find('input[name=updateId]').val($(this).data('id'));
            modal.modal('show');
        });

        $('#updateBtn').on('shown.bs.modal', function(e) {
            $(document).off('focusin.modal');
        });
        $('#addModal').on('shown.bs.modal', function(e) {
            $(document).off('focusin.modal');
        });

    })(jQuery);
</script>

@endpush