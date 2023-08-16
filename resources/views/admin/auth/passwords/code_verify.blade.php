@extends($activeTemplate.'layouts.auth')
@section('content')
<!-- Forgot Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
         <a href="{{url('/')}}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1">OTP  🔒</h4>
        <p class="card-text mb-2">Please enter the code sent to your email in the field below</p>

          <form action="{{ route('admin.password.verify.code') }}" method="POST" class="cmn-form mt-30">
                    @csrf
                    <div class="form-group mb-1">
                        <label>@lang('Verification Code')</label>
                        <input type="text" name="code" id="code" class="form-control">
                    </div>
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.password.reset') }}" class="text-muted text--small">@lang('Try to send again')</a>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn  btn--primary text-white submit-btn mt-25 b-radius--capsule">@lang('Verify Code') <i class="las la-sign-in-alt"></i></button>
                    </div>
                </form>


      </div>
    </div>
    <!-- /Forgot Password v1 -->

@endsection

@push('script')
<script>
    (function($){
        "use strict";
        $('#code').on('input change', function () {
          var xx = document.getElementById('code').value;
          $(this).val(function (index, value) {
             value = value.substr(0,7);
              return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
          });
      });
    })(jQuery)
</script>
@endpush
