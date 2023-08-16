@extends($activeTemplate.'layouts.auth')

@section('content')
 <!-- Forgot Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="{{url('/')}}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1 text-center">@lang('Reset Password') 🔒</h4>
        <p class="card-text mb-2">Enter your email or username and we'll send you instructions to reset your password</p>

          <form method="POST" class="auth-forgot-password-form mt-2"  action="{{ route('user.password.email') }}">
          @csrf
          <div class="mb-1">
            <label for="forgot-password-email" class="form-label">@lang('Select One')</label>
           <select class="form-control" name="type">
                                    <option value="email">@lang('E-Mail Address')</option>
                                    <option value="username">@lang('Username')</option>
            </select>
          </div>

          <div class="mb-1">
             <label class="col-md-4 col-form-label text-md-right my_value"></label>
           <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autofocus="off">

                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          </div>
          <button class="btn btn--primary text-white w-100" type="submit" tabindex="2"> @lang('Send Password Code')</button>
        </form>

        <p class="text-center mt-2">
          <a href="{{ route('user.login') }}"> <i data-feather="chevron-left"></i> Back to login </a>
        </p>
      </div>
    </div>
    <!-- /Forgot Password v1 -->

@endsection
@push('script')
<script>

    (function($){
        "use strict";

        myVal();
        $('select[name=type]').on('change',function(){
            myVal();
        });
        function myVal(){
            $('.my_value').text($('select[name=type] :selected').text());
        }
    })(jQuery)
</script>
@endpush

@push('script-lib')
<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/pages/page-auth-forgot-password.min.js') }}"></script>
@endpush
