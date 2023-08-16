@extends('admin.layouts.app')
@section('panel')

<div class="row">
    <div class="col-lg-12 mb-30">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="profilePicUpload1" class="bg--primary">@lang('Update Line') </label>
                        <input type="text" class="form-control" id="footerContent1" name="footerContent1" value="{{ $footerContent[0]->data_text }}">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="profilePicUpload1" class="bg--primary">@lang('Update Line') </label>
                        <input type="text" class="form-control" id="footerContent2" name="footerContent2" value="{{ $footerContent[1]->data_text }}">
                    </div>
                    <br>
                    <button type="submit" class="btn btn--primary text-white w-25">@lang('Update')</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-sm btn--primary text-white box--shadow1 text--small addBtn waves-effect waves-float waves-light"><i class="fa fa-fw fa-plus"></i>@lang('Add New Link')</a>
                    <hr>
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('SL')</th>
                                    <th>@lang('Text')</th>
                                    <th>@lang('Link')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($footerElements as $footerElement)
                                <tr>
                                    <td data-label="@lang('SL')">{{$loop->iteration}}</td>
                                    <td data-label="@lang('Text')">
                                        {{ $footerElement->data_text }}
                                    </td>
                                    <td data-label="@lang('Link')">
                                        {{ $footerElement->data_text2 }}
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <button class="btn btn-sm text-white updateBtn" data-id="{{$footerElement->id}}" data-text="{{$footerElement->data_text}}" data-url="{{$footerElement->data_text2}}">
                                            Edit
                                        </button>

                                        <button class="btn btn-danger btn-sm removeBtn" data-id="{{ $footerElement->id }}">Delete</button>
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
                <form action="{{ route('admin.setting.dashboard.footer.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="createLinkText">@lang('New Link Text')</label>
                            <div class="avatar-edit">
                                <input type="text" class="form-control" name="text" id="createLinkText" placeholder="Link Text" required>
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label for="createLinkUrl">@lang('New Link Url')</label>
                            <div class="avatar-edit">
                                <input type="text" class="form-control" name="url" id="createLinkUrl" placeholder="https://yourdomain.com/" required>
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
                    <h5 class="modal-title">@lang('Update Item')</h5>
                </div>
                <form action="{{ route('admin.setting.dashboard.footer.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="updateId">
                    <div class="modal-body">
                        <div class="form-group mb-1">
                            <label for="updateLinkText">@lang('New Link Text')</label>
                            <div class="avatar-edit">
                                <input type="text" class="form-control" name="text" id="updateLinkText" placeholder="Link Text" required>
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label for="updateLinkUrl">@lang('New Link Url')</label>
                            <div class="avatar-edit">
                                <input type="text" class="form-control" name="url" id="updateLinkUrl" placeholder="https://yourdomain.com/" required>
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
                <form action="{{ route('admin.setting.dashboard.footer.destroy') }}" method="POST">
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
                $('#updateLinkUrl').val($(this).data('url'));
                $('#updateLinkText').val($(this).data('text'));
                modal.modal('show');
                console.log($(this).data('id'));
                console.log($(this).data('url'));
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