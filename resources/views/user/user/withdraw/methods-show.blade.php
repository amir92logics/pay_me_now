@extends($activeTemplate.'layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('user.withdraw-methods.index') }}" class="btn btn-primary btn-sm"><i data-feather='arrow-left-circle'></i> Back</a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Method Name</th>
                        <td>{{ $method->name }}</td>

                        <th>Delay</th>
                        <td>{{ $method->delay }}</td>
                    </tr>
                    <tr>
                        <th>Min limit</th>
                        <td>${{ number_format($method->min_limit, 2) }}</td>

                        <th>Max limit</th>
                        <td>${{ number_format($method->max_limit, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Charge</th>
                        <td>${{ number_format($method->charge_type == 'percentage' ? $method->percent_charge:$method->fixed_charge, 2) }}</td>
                        <th>Rate</th>
                        <td>{{ $method->rate }}</td>
                    </tr>
                    <tr>
                        <th>Currency</th>
                        <td>{{ $method->currency }}</td>
                        <th>Image</th>
                        <td><img class="img-fluid" width=50" src="{{ asset('assets/images/withdraw/method/'.$method->image) }}" alt="Card image cap"></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td colspan="3">{{ $method->description }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.withdraw-methods.update', $method->id) }}" method="POST" class="ajaxform_instant_reload">
                    @csrf
                    @method('put')

                    <div class="row">
                        @foreach ($method->user_data as $key => $field)
                            <div class="col-12 mb-1">
                                <label>{{ $field->field_level ?? 'Optional' }}</label>
                                <input type="text" class="form-control" placeholder="Enter {{ $field->field_level }}" name="{{ $field->field_name ?? $key }}" {{ $field->validation ?? '' }} value="{{ $usermethod->withdraw_infos[$key] ?? '' }}">
                            </div>
                        @endforeach
                    </div>

                    <div class="row justify-content-end text-end">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm text-end submit-btn"><i data-feather='save'></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
