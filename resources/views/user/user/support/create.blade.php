@extends($activeTemplate.'layouts.dashboard')

@section('content') 
                <div class="card">
                    <div class="card-header">{{ __($pageTitle) }}
                        <a href="{{route('user.support') }}" class="btn btn-sm btn-success float-right">

                            @lang('Back')
                        </a>
                    </div>

                    <div class="card-body">
                        <form  action="{{route('user.ticket.create') }}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-1">
                                    <label for="department">@lang('Desk')</label>
                                    <select name="department" class="form-control">
                                    @foreach($topics as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6 mb-1">
                                    <label for="priority">@lang('Priority')</label>
                                    <select name="priority" class="form-control">

                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>

                                    </select>
                                </div>

                                <div class="form-group col-md-12 mb-1">
                                    <label for="website">@lang('Subject')</label>
                                    <input type="text" name="subject" value="{{old('subject')}}" class="form-control" placeholder="@lang('Subject')" >
                                </div>

                                <div class="col-12 form-group mb-1">
                                    <label for="inputMessage">@lang('Message')</label>
                                    <textarea
                  data-length="100"
                  class="form-control char-textarea"
                  id="textarea-counter"
                  rows="3"
                  placeholder="Enter Message Here"
                  style="height: 100px"
                  name="message"
                >{{old('message')}}</textarea>
                <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 100 </small>

                                </div>
                            </div>

                            <div class="row form-group ">
                                <div class="col-sm-12 file-upload">
                                    <label for="inputAttachments">@lang('Attachments')</label>
                                    <div class="input-group">
                <input
                  type="file" name="attachments[]"
                  id="inputAttachments"
                  class="form-control"
                  placeholder="Button on right"
                  aria-describedby="button-addon2"
                />
                <button class="btn btn-outline-primary text-white addFile" id="button-addon2" type="button"><i data-feather="plus"></i></button>
              </div>
              <br>


                                    <div id="fileUploadsContainer"></div>
                                    <p class="ticket-attachments-message text-muted">
                                        @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                    </p>
                                </div>

                            </div>

                            <div class="row form-group justify-content-center">
                                <div class="col-md-12">
                                    <button class="btn btn--success text-white" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
 @endsection


@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.addFile').on('click',function(){
                $("#fileUploadsContainer").append(`
                    <div class="input-group">
                        <input type="file" name="attachments[]" class="form-control" required />
                            <button class="btn btn-danger remove-btn">x</button>

                    </div><br>
                `)
            });
            $(document).on('click','.remove-btn',function(){
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
@endpush
