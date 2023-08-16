@extends($activeTemplate.'layouts.auth')
@section('content')
<!-- Forgot Password v1 -->
    <div class="card mb-0">
      <div class="card-body">
         <a href="{{url('/')}}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1">Forgot Password? 🔒</h4>
        <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>

         <form action="{{ route('admin.password.reset') }}" method="POST" class="cmn-form mt-30">
                    @csrf
                    <div class="form-group mb-1">
                        <label for="email">@lang('Email')</label>
                        <input type="email" name="email" class="form-control b-radius--capsule" id="username" value="{{ old('email') }}" placeholder="@lang('Enter your email')">
                        <i class="las la-user input-icon"></i>
                    </div>
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.login') }}" class="text-muted text--small"><i class="las la-lock"></i>@lang('Login Here')</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn btn  btn--primary text-white mt-25 b-radius--capsule">@lang('Send Reset Code') <i class="las la-sign-in-alt"></i></button>
                    </div>
                </form>


      </div>
    </div>
    <!-- /Forgot Password v1 -->

@endsection
