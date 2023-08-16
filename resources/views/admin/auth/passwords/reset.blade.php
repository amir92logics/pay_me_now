@extends($activeTemplate.'layouts.auth')
@section('content')
<!-- Forgot Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
         <a href="{{url('/')}}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1">Reset Password  🔒</h4>
        <p class="card-text mb-2">Please enter your new password in the field below</p>

          <form action="{{ route('admin.password.change') }}" method="POST" class="cmn-form mt-30">
                    @csrf

                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="pass">@lang('New Password')</label>
                        <input type="password" name="password" class="form-control b-radius--capsule" id="password" placeholder="@lang('New password')">
                        <i class="las la-lock input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="pass">@lang('Retype New Password')</label>
                        <input type="password" name="password_confirmation" class="form-control b-radius--capsule" id="password_confirmation" placeholder="@lang('Retype New password')">
                        <i class="las la-lock input-icon"></i>
                    </div>

                    <div class="form-group d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.login') }}" class="text-muted text--small"><i class="las la-lock"></i>@lang('Login Here')</a>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn btn  btn--primary text-white mt-25 b-radius--capsule">@lang('Reset Password') <i class="las la-sign-in-alt"></i></button>
                    </div>
                </form>


      </div>
    </div>
    <!-- /Forgot Password v1 -->

@endsection
