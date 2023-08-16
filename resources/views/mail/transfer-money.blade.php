@component('mail::message')
<h1 style="text-align: center; color: #6777ef;"> {{ env('APP_NAME') }}</h1>
<br>
<p>You have received ${{ $options['amount'] }} form <b>{{ $options['name'] }}</b>, Please check and accept.</p>

@component('mail::button', ['url' => $options['url'].'?='.$options['email']])
RECEIVE MONEY
@endcomponent

<p>{{ __('Thanks') }},</p>
<p>{{ env('APP_NAME') }}.</p>
@endcomponent
