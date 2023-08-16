@extends($activeTemplate.'layouts.dashboard')
@section('content')
    <div class="container card">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-6 col-md-6">
                @if(Auth::user()->ts)
                    <div class="custom--card">
                        <div class="card-header">
                          <center>  <h3 class="card-title">@lang('Two Factor Authenticator')</h3></center>
                        </div>
                        <div class="card-body text-center">
                            <p class="fs--14px mb-2">@lang('Use Google Authentication ') <a class="text--base" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">@lang('App Link')</a></p>
                            <div class="form-group mx-auto text-center">
                                <a href="#0"  class="btn btn--base w-100" data-bs-toggle="modal" data-bs-target="#disableModal">
                                    @lang('Disable Two Factor Authenticator')</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="custom--card">
                        <div class="card-header text-center">
                            <h3 class="card-title">@lang('Two Factor Authenticator')</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group mx-auto text-center">
                                <img class="mx-auto" src="{{$qrCodeUrl}}">
                                <p class="fs--14px mt-2">@lang('Use Google Authentication App to scan the QR code') <a class="text--base" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">@lang('App Link')</a></p>
                            </div>
                            <div class="form-group mt-4">
                                <div class="input-group">
                                    <input type="text" name="key" value="{{$secret}}" class="form-control" id="referralURL" readonly>
                                    <span class="input-group-text copytext bg--base" id="copyBoard "> <i class="text-white" data-feather='clipboard'></i> </span>
                                </div>
                            </div>

                            <div class="form-group mx-auto text-center">
                                <a href="#0" class="btn text-white btn--primary me-1 mt-1" data-bs-toggle="modal" data-bs-target="#enableModal">@lang('Enable Two Factor Authenticator')</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <!--Enable Modal -->
    <div id="enableModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your Otp')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <form action="{{route('user.twofactor.enable')}}" method="POST">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-group">
                            <input type="hidden" name="key" value="{{$secret}}">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning me-1 mt-1" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary text-white me-1 mt-1">@lang('Verify')</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your Otp Disable')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <form action="{{route('user.twofactor.disable')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning me-1 mt-1" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn text-white btn--primary me-1 mt-1">@lang('Verify')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        (function($){
            "use strict";

            $('.copytext').on('click',function(){
                var copyText = document.getElementById("referralURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});
            });
        })(jQuery);
    </script>
@endpush


