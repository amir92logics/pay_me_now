@extends($activeTemplate.'layouts.auth')

@section('content')
 <!-- Forgot Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="{{ route('user.login') }}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1 text-center">@lang('Reset Password') 🔒</h4>
        <p class="card-text mb-2">Enter the verification code sent to your email address<br>
        @lang('Please check including your Junk/Spam Folder. if not found, you can')
        </p>

          <form method="POST" class="auth-forgot-password-form mt-2"  action="{{ route('user.password.verify.code') }}">
          @csrf


          <div class="mb-1">
          <input type="hidden" name="email" value="{{ $email }}">

             <label class="col-md-4 col-form-label">@lang('Verification Code')</label>
           <input type="text" class="form-control" name="code" id="code" value="{{ old('code') }}" required autofocus="off">

          </div>
          <br>
          <button class="btn  btn--primary text-white w-100" type="submit" tabindex="2"> @lang('Verify Code')</button>
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
