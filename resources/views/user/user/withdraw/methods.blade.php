@extends($activeTemplate.'layouts.dashboard')

@section('content')

<div class="row">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('Currently on the way to your bank account') }}</h4>
                        <h4 class="font-weight-bold text-warning">${{ $pending_amount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($methods as $method)
    <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                    <h4 class="card-title mb-1">{{ $method->name }}</h4>
                   
                </div>
                    <img height="30" src="{{ asset('assets/images/withdraw/method/'.$method->image) }}" alt="Card image cap">
                
            </div>
                {{-- <img class="img-fluid" src="{{ asset('assets/images/withdraw/method/'.$method->image) }}" alt="Card image cap"> --}}
                <table class="table mt-1">
                    <tr>
                        <th class="p-0">Charge</th>
                        <td class="p-0 text-end">${{ number_format($method->charge_type == 'percentage' ? $method->percent_charge:$method->fixed_charge, 2) }}</td>
                    </tr>
                </table>
                <div class=" mt-1">
                    @if ($method->user_data && $method->usermethod && optional($method->usermethod)->withdraw_infos == null)
                        <a class="btn btn-warning rounded btn-sm" href="{{ route('user.withdraw-methods.show', $method->id) }}">
                            <i data-feather='edit'></i>
                        </a>
                    @elseif ($method->usermethod)
                        <div class="btn-group">
                            <a class="btn btn-primary btn-sm" href="{{ route('user.make-withdraw', $method->id) }}">
                                {{ __('Withdraw') }} <i data-feather='dollar-sign'></i>
                            </a>
                        </div>
                    @endif
                     @if ($method->usermethod)
                    <a class="text-warning float-end" href="{{ route('user.withdraw-methods.show', $method->id) }}">
                        <i data-feather='edit'></i>
                    </a>
                    @endif
                    @if (!$method->usermethod)
                    <a href="{{ route('user.make-withdraw', $method->id) }}" class="btn btn-primary btn-sm"><i data-feather='arrow-right-circle'></i></a>
                        <a class="btn btn-primary btn-sm float-end" href="{{ route('user.withdraw-methods.show', $method->id) }}">
                            {{ __('Set up') }}
                        </a>
                    @endif
                    {{-- @if (!$method->usermethod)
                        <a class="btn btn-primary btn-sm" href="{{ route('user.withdraw-methods.show', $method->id) }}">
                            {{ __('Set up') }}
                        </a>
                    @endif --}}
                </div>
                
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
