@extends($activeTemplate . 'layouts.auth')
@section('content')
    @php
        $mobile_code = @implode(',', $info['code'] ?? []);
        $countries = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $policy = getContent('policy_pages.element');
    @endphp
    <!-- Register v1 -->
    <div class="card mb-0">
        <div class="card-body">
            <a href="{{ url('/') }}" class="brand-logo center">
                <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" width="50" alt="logo"></a>
            </a>

            <h4 class="card-title mb-1 text-center">Adventure starts here 🚀</h4>
            <p class="card-text mb-2">@lang('If you do not have an account with us, please register to have one.')</p>

            <form class="auth-register-form mt-2" action="{{ route('user.register') }}" method="post">
                @csrf
                <div class="row">
                    <div class="mb-1 col-6">
                        <label for="firstname" class="form-label">@lang('First Name')</label>
                        <input type="text" class="form-control" id="firstname" name="firstname"
                            value="{{ old('firstname') }}" placeholder="Enter First Name" aria-describedby="firstname"
                            tabindex="1" autofocus />
                    </div>
                    <div class="mb-1 col-6">
                        <label for="lastname" class="form-label">@lang('Last Name')</label>
                        <input type="text" class="form-control" id="lastname" name="lastname"
                            value="{{ old('lastname') }}" placeholder="Enter Last Name" aria-describedby="lastname"
                            tabindex="2" />
                    </div>

                </div>
                <div class="row">
                    <div class="mb-1 col-6">
                        <label for="legalbusinessname" class="form-label">@lang('Legal Business Name')</label>
                        <input type="text" class="form-control" id="legalbusinessname" name="legalbusinessname"
                            value="{{ old('legalbusinessname') }}" placeholder="Enter Legal Business Name" aria-describedby="legalbusinessname"
                            tabindex="1" autofocus />
                    </div>
                    <div class="mb-1 col-6">
                        <label for="title" class="form-label">@lang('Title')</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title') }}" placeholder="Enter Title" aria-describedby="title"
                            tabindex="2" />
                    </div>

                </div>
                <div class="row">
                    <div class="mb-1 col-6">
                        <label for="city" class="form-label">@lang('City')</label>
                        <input type="text" class="form-control" id="city" name="city"
                            value="{{ old('city') }}" placeholder="Enter City" aria-describedby="city"
                            tabindex="1" autofocus />
                    </div>
                    <div class="mb-1 col-6">
                        <label for="state" class="form-label">@lang('State')</label>
                        <input type="text" class="form-control" id="state" name="state"
                            value="{{ old('state') }}" placeholder="Enter State" aria-describedby="state"
                            tabindex="2" />
                    </div>

                </div>

                <div class="row">
                    <div class="mb-1 col-6">
                        <label for="currency" class="form-label">{{ __('Country') }}</label>
                        <select name="country" id="currency" onchange="myFunction()" required class="form-control">
                            @foreach ($countries as $key => $country)
                                <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}"
                                    data-code="{{ $key }}">{{ __($country->country) }}</option>
                            @endforeach
                        </select>
                    </div>
                    @push('script')
                        <script>
                            function myFunction() {
                                var mobile_code = $("#currency option:selected").attr('data-mobile_code');
                                var code = $("#currency option:selected").attr('data-code');
                                document.getElementById("code").value = code;
                                document.getElementById("mobile_code").value = mobile_code;
                                document.getElementById("22").innerHTML = "+" + mobile_code;
                            };
                        </script>
                    @endpush
                    <div class="mb-1 col-6">
                        <label for="firstname" class="form-label">@lang('Mobile')</label>
                        <input name="mobile" id="mobile" class="form-control" id="mobile"
                            value="{{ old('mobile') }}" placeholder="Phone Number" aria-describedby="mobile" tabindex="1"
                            autofocus />
                    </div>

                    <input type="hidden" id="mobile_code" name="mobile_codes">
                    <input type="hidden" id="code" name="country_codes">

                </div>
                <div class="mb-1">
                <div class="d-flex flex-column">
              <label class="form-check-label" for="customSwitch3">Is your business currently operational?</label>
              <div class="demo-inline-spacing">
            <div class="form-check form-check-inline">
              <input
                class="form-check-input"
                type="radio"
                name="chargepay"
                id="inlineRadio1"
                value="1" checked

              />
              <label class="form-check-label" for="inlineRadio1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input
                class="form-check-input"
                type="radio"
                name="chargepay"
                id="inlineRadio2"
                value="2" checked
              />
              <label class="form-check-label" for="inlineRadio2">No</label>
            </div>
            </div>
            <div class="row additional mt-1">
                    <div class="mb-1 col-12">
                        <label for="expectoperational" class="form-label">@lang('When do you expect to be operational??')</label>
                        <input type="text" class="form-control" id="expectoperational" name="expectoperational"
                            value="{{ old('expectoperational') }}" placeholder="Please Enter" aria-describedby="expectoperational"
                            tabindex="1" autofocus />
                    </div>

                </div>
                <div class="row mt-1">
                    <div class="mb-1 col-12">
                        <label for="howhear" class="form-label">@lang('How did you hear about PayMeNow?')</label>
                        <input type="text" class="form-control" id="howhear" name="howhear"
                            value="{{ old('howhear') }}" placeholder="Enter First Name" aria-describedby="howhear"
                            tabindex="1" autofocus />
                    </div>

                </div>
                <div class="row">
                   
                    <div class="mb-1 col-6">
                        <label for="referral" class="form-label">@lang('Referral code (optional)')</label>
                        <input type="text" class="form-control" id="referral" name="referral"
                            value="{{ old('referral') }}" placeholder="Enter First Name" aria-describedby="referral"
                            tabindex="1" autofocus />
                    </div>
                    <div class="mb-1 col-6">
                        <label for="businesstype" class="form-label">@lang('Business Type')</label>
                        <input type="text" class="form-control" id="businesstype" name="businesstype"
                            value="{{ old('businesstype') }}" placeholder="Enter Business Type" aria-describedby="businesstype"
                            tabindex="1" autofocus />
                    </div>
                </div>
                
                <div class="row">
                   
                   <div class="mb-1 col-12">
                   <label class="form-check-label" for="accounttype">
                                @lang('Which type of account are you applying for? (select all that apply)')
                            </label>
                   </div>
               </div>
                <div class="mb-1">
                        <div class="form-check">
                            <input class="form-check-input" name="agree" type="checkbox" id="premier-account"
                                tabindex="4" />
                            <label class="form-check-label" for="premier-account">
                                @lang('Premier Account - pay vendors, utilities, taxes and employees.')
                            </label>
                        </div>
                        </div>

                <div class="mb-1">

                        <div class="form-check">
                            <input class="form-check-input" name="agree" type="checkbox" id="paytender-account"
                                tabindex="4" />
                            <label class="form-check-label" for="paytender-account">
                                @lang('Paytender Account -  accept customer payments.  ')
                            </label>
                        </div>
                        </div>
                
                <div class="mb-1">
                    <label for="register-username" class="form-label">{{ __('Username') }}</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username"
                        aria-describedby="username" tabindex="1" autofocus />
                </div>
                <div class="mb-1">
                    <label for="register-email" class="form-label">@lang('E-Mail Address')</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com"
                        aria-describedby="email" value="{{ request('email') ?? old('email') }}" tabindex="2" {{ request('email') ? 'readonly':'' }}/>
                </div>

                <div class="row">
                    <div class="mb-1 col-6">
                        <label for="register-password" class="form-label">@lang('Password')</label>

                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password" name="password"
                                placeholder="Enter Password
                aria-describedby="password" tabindex="3" />
                            <span class="input-group-text cursor-pointer bg-light text-black"><i
                                    data-feather="eye"></i></span>
                        </div>
                    </div>
                    <div class="mb-1 col-6">
                        <label for="register-password" class="form-label">@lang('Confirm Password')</label>

                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm Password"
                                aria-describedby="password_confirmation" tabindex="3" />
                            <span class="input-group-text cursor-pointer bg-light text-black"><i
                                    data-feather="eye"></i></span>
                        </div>
                    </div>
                    <div class="mb-1">
                        <div class="form-check">
                            <input class="form-check-input" name="agree" type="checkbox" id="register-privacy-policy"
                                tabindex="4" />
                            <label class="form-check-label" for="register-privacy-policy">
                                @lang('I agree with ')
                                @foreach ($policy as $singleData)
                                    <a href="{{ route('privacy.page', ['slug' => slug($singleData->data_values->title), 'id' => $singleData->id]) }}"
                                        class="text--base" target="_blank">
                                        {{ __($singleData->data_values->title) }} {{ $loop->last == true ? '.' : ',' }}
                                    </a>
                                @endforeach
                            </label>
                        </div>
                        <br><br>
                        <button class="btn btn--primary text-white w-100" type="submit"
                            tabindex="5">@lang('Register')</button>
                            </div>

            </form>

            <p class="text-center mt-2">
                <span>@lang('You already have an account? ')<br></span>
                <a href="{{ route('user.login') }}">
                    <span>@lang('Login')</span>
                </a>
            </p>


        </div>
    </div>
    <!-- /Register v1 -->
@endsection

@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/pages/page-auth-register.min.js') }}"></script>
    <script>
          $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        if (inputValue == 2) {
        $("." + 'additional').toggle();
        }else{
        $("." + 'additional').hide();

        }
    });
        </script>
@endpush
