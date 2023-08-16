@extends($activeTemplate . 'layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('user.withdraw-methods.index') }}" class="btn btn-primary btn-sm rounded-pill"><i data-feather='arrow-left-circle'></i> Back</a>
                    <h4 class="text-primary">{{ $method->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.payout.get-otp', $method->id) }}" method="post" class="mb-3 ajaxform_instant_reload">
                        @csrf
                        <div class="input-group input-group-merge mb-2">
                            <input type="number" step="any" class="form-control" placeholder="Amount" name="amount" aria-describedby="basic-addon-search2">
                            <button class="input-group-text btn btn-primary submit-btn" id="basic-addon-search2" type="submit">Go</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-body">
                    <h4 class="text-primary mb-2">Your credentials</h4>
                    <div class="row">
                        <table class="table table-striped">
                            <tbody>
                                @foreach ($method->user_data as $key => $field)
                                    <tr>
                                        <td>{{ $field->field_level ?? 'Optional' }}</td>
                                        <td>{{ $usermethod->withdraw_infos[$key] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-body">
                    <h4 class="text-primary mb-2">Withdraw method information</h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Method name</th>
                                    <th>Image</th>
                                    <th>Minimum limit</th>
                                    <th>Maximum limit</th>
                                    <th>Charge type</th>
                                    <th>Charge</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $method->name }}</td>
                                    <td><img height="30" src="{{ asset('assets/images/withdraw/method/'.$method->image) }}" alt=""></td>
                                    <td>{{ $method->min_limit }}</td>
                                    <td>{{ $method->max_limit }}</td>
                                    <td>{{ $method->charge_type }}</td>
                                    <td>{{ $method->charge_type == 'percentage' ? $method->percent_charge.'%' : '$'.$method->fixed_charge }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
