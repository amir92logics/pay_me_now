@extends($activeTemplate.'layouts.auth')

@section('content')
     <!-- Login v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="{{url('/')}}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1">@lang('Welcome back to '){{$general->sitename}} 🔒</h4>
        <p class="card-text mb-2">@lang('If you do not have an account with us, please register to have one.')</p>

        <form method="POST" class="auth-login-form mt-2" action="{{ route('user.login')}}" onsubmit="return submitUserForm();">
         @csrf
          <div class="mb-1">
            <label for="login-email" class="form-label">@lang('Username or Email')</label>
            <input
              type="text"
              class="form-control"
              id="username"
              name="username"
              placeholder="Enter Username or Email"
              aria-describedby="login-email"
              tabindex="1"
              autofocus
            />
          </div>

          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="login-password">{{ __('Password') }}</label>
              <a href="{{route('user.password.request')}}">
                <small> @lang('Forgot Your Password?')</small>
              </a>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input
                type="password"
                class="form-control form-control-merge"
                id="password"
                name="password"
                tabindex="2"
                placeholder="****** "
                aria-describedby="login-password"
              />
              <span class="input-group-text cursor-pointer bg-light text-primary"><i data-feather="eye"></i></span>
            </div>
          </div>

            <div class="mb-1">
            <div class="d-flex justify-content-between">
            @php echo loadReCaptcha() @endphp
            </div>
            </div>
            @include($activeTemplate.'partials.custom_captcha')


          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} tabindex="3" />
              <label class="form-check-label" for="remember">  @lang('Remember Me') </label>
            </div>
          </div>
          <button class="btn btn--primary text-white w-100" tabindex="4">@lang('Login')</button>
        </form>

        <p class="text-center mt-2">
          <span>New on our platform?</span>
          <a href="{{ route('user.register') }}">
            <span>@lang('Register')</span>
          </a>
        </p>

      </div>
    </div>
    <!-- /Login v1 -->
@endsection

@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
    </script>
@endpush
