@extends('admin.layouts.app')
@section('panel')



                  <!-- drives area starts-->
    <div class="drives">
      <div class="row">
        <div class="col-12">
          <h6 class="files-section-title mb-75">Drives</h6>
        </div>
         @php $total =  App\Models\Cryptowallet::count(); @endphp
        @foreach($currency as $data)
        @php $wallets =  App\Models\Cryptowallet::whereCoinId($data->id)->count(); @endphp
        <div class="col-lg-3 col-md-6 col-12">
          <div class="card shadow-none border cursor-pointer">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                 <img src="{{url('/')}}/assets/images/coins/{{$data->image}}"  width="50" alt="logo"></span>
                <div class="dropdown-items-wrapper">
                  <i
                    data-feather="more-horizontal"
                    id="dropdownMenuLink1"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  ></i>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink1">
                    <a class="dropdown-item" href="{{route('admin.coin.viewwallet',$data->symbol)}}">
                      <i data-feather="eye" class="me-25"></i>
                      <span class="align-middle">View Wallets</span>
                    </a>

                  </div>
                </div>
              </div>
              <div class="my-1">
                <h5>{{$data->name}}</h5>
              </div>
              <div class="d-flex justify-content-between mb-50">
                <span class="text-truncate">Total Wallet:</span>
                <small class="text-muted">{{@$wallets}}</small>
              </div>
              <div class="progress progress-bar-primary progress-md mb-0" style="height: 10px">
                <div
                  class="progress-bar"
                  role="progressbar"
                  aria-valuenow="100"
                  aria-valuemin="{{$wallets/$total*100}}"
                  aria-valuemax="100"
                  style="width: {{$wallets/$total*100}}%"
                ></div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <!-- drives area ends-->


@endsection

