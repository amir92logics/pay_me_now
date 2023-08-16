@component('mail::message')
<h1 style="text-align: center; color: #6777ef;"> {{ env('APP_NAME') }}</h1>

<h1>{{ __('Hi') }},</h1>
<p>{{ __('Your withdrawal amount is') }}: {{ '$' . $amount }}</p>
<p>{{ __('If you did try to withdraw, copy and paste this verification code') }}:</p>
<h3 style="text-align: center;background: #FAFAFA; padding: 10px">{{ $otp }}</h3>

<p>{{ __('Thanks') }},</p>
<p>{{ env('APP_NAME') }}.</p>
@endcomponent
