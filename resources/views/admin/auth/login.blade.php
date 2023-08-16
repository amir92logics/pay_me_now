@extends($activeTemplate.'layouts.auth')
@section('content')
 <!-- Login v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="{{url('/')}}" class="brand-logo center">
           <img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" width="50" alt="logo"></a>

        </a>

        <h4 class="card-title mb-1">{{$general->sitename}} @lang('Admin ')🔒</h4>
        <p class="card-text mb-2">@lang('Login To Admin ackend.')</p>

        <form action="{{ route('admin.login') }}" method="POST" class="cmn-form mt-30">
                    @csrf
                    <div class="form-group mb-1">
                        <label for="email">@lang('Username')</label>
                        <input type="text" name="username" class="form-control b-radius--capsule" id="username" value="{{ old('username') }}" placeholder="@lang('Enter your username')">
                        <i class="las la-user input-icon"></i>
                    </div>
                    <div class="form-group mb-1">
                        <label for="pass">@lang('Password')</label>
                        <input type="password" name="password" class="form-control b-radius--capsule" id="pass" placeholder="@lang('Enter your password')">
                        <i class="las la-lock input-icon"></i>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn--primary text-white ">@lang('Login') <i class="las la-sign-in-alt"></i></button>
                    </div>
                </form>

        <p class="text-center mt-2">
          <span>@lang('Forgot password?')</span>
          <a href="{{ route('admin.password.reset') }}">
            <span>@lang('Reset password?')</span>
          </a>
        </p>

      </div>
    </div>
    <!-- /Login v1 -->

@endsection

