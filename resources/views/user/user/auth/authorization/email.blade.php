@extends($activeTemplate.'layouts.auth')
@section('content')
 <!-- Email Verify v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="{{ route('user.login') }}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1 text-center">@lang('Verify Email') 🔒</h4>
        <p class="card-text mb-2">@lang('Please Enter The Verification Code Sent To Your Email to Get Access To Your Account')
        </p>

          <form method="POST" class="auth-forgot-password-form mt-2"  action="{{route('user.verify.email')}}">
          @csrf

          <div class="mb-1">
             <label class="col-md-4 col-form-label">@lang('Verification Code')</label>
           <input type="text" name="email_verified_code" class="form-control" maxlength="7" id="code">

          </div>
          <button class="btn  btn--primary text-white w-100" type="submit" tabindex="2"> @lang('Verify Code')</button>
        </form>

         <p class="text-center mt-2">
          <span>@lang('Please check including your Junk/Spam Folder. if not found, you can')</span>
          <a href="{{route('user.send.verify.code')}}?type=email">
            <span>@lang('Resend code')</span>
          </a>
        </p>

      </div>
    </div>
    <!-- /Email Verify v1 -->
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



