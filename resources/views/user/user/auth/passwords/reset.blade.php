
@extends($activeTemplate.'layouts.auth')

@section('content')
 <!-- Forgot Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="{{url('/')}}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1 text-center">@lang('Reset Password') 🔒</h4>
        <p class="card-text mb-2">@lang('Enter Your New Password & Confirm The Password To Reset Your Password')
        </p>

          <form method="POST" class="auth-forgot-password-form mt-2"  action="{{ route('user.password.update') }}">
          @csrf


          <div class="mb-1">
           <input type="hidden" name="email" value="{{ $email }}">
           <input type="hidden" name="token" value="{{ $token }}">

             <label class="col-md-4 col-form-label">@lang('Password')</label>
           <input id="password" type="password" Placeholder="Enter New Password" class="form-control @error('password') is-invalid @enderror" name="password" required>

          </div>
          <div class="mb-1">
             <label class="col-md-4 col-form-label">@lang('Confirm Password')</label>
           <input id="password-confirm" placeholder="Confirm New Password" type="password" class="form-control" name="password_confirmation" required>

          </div>
          <button class="btn  btn--primary text-white w-100" type="submit" tabindex="2">  @lang('Reset Password')</button>
        </form>

        <p class="text-center mt-2">
          <a href="{{ route('user.login') }}"> <i data-feather="chevron-left"></i> @lang('Try to send again') </a>
        </p>
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

