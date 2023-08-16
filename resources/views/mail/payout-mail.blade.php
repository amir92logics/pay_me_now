@component('mail::message')
<h1 style="text-align: center; color: #6777ef;">@lang('Withdraw request from') {{ env('APP_NAME') }}</h1>

<table style="width: 100%; border: 1px solid #000">
    <thead style="background: rgb(248,249,250); padding: 10px 0;">
        <tr>
            <th>{{ __('Amount') }}</th>
            <th>{{ __('Charge') }}</th>
            <th>{{ __('Method Name') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>{{ $payout->amount }}</th>
            <th>{{ $payout->charge }}</th>
            <th>{{ $method_name }}</th>
        </tr>
    </tbody>
</table>
@endcomponent
