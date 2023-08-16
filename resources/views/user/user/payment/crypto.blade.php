@extends($activeTemplate.'layouts.dashboard')

@section('content')
 <div class="checkout-options">
          <div class="card">
            <div class="card-body">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="custom--card">
                    <div class="card-header card-header-bg">
                        <h3 class="text-center">@lang('Payment Preview')</h3>
                    </div>
                    <div class="card-body card-body-deposit text-center">
                        <h4 class="my-2"> @lang('PLEASE SEND EXACTLY') <span class="text--base"> {{ $data->amount }}</span> {{__($data->currency)}}</h4>
                        <h5 class="mb-2">@lang('TO') <span class="text--base"> {{ $data->sendto }}</span></h5>
                        <img src="{{$data->img}}" alt="@lang('Image')">
                        <h4 class="text-white bold my-4 text--base">@lang('SCAN TO SEND')</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </div>    </div>    </div>
@endsection
