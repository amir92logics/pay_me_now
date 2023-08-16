@extends($activeTemplate.'layouts.dashboard')

@section('content')
<section id="dashboard-ecommerce">
  <div class="row match-height">


    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __($pageTitle) }}
                         
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-responsive-xl table-responsive-lg table-responsive-md table-responsive-sm">
                            <table class="table ">
                                <thead class="thead-dark">
                                <tr>
                                    <th>@lang('id')</th>
                                    <th>@lang('Location')</th>
                                    <th>@lang('Date Added')</th> 
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($atm as $key)
                                    <tr>
                                        <td data-label="@lang('ID')"> <a href="#" class="font-weight-bold">{{$loop->iteration}}</a></td>
                                        <td data-label="@lang('Location')"> <a href="#" class="font-weight-bold">{{ __($key->name) }} </a></td>

                                        <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($key->created_at)->diffForHumans() }} </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
 
                     </div>
                </div>
            </div>
        </div>
    </div>    </div>    </div>
@endsection
