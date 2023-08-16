@extends('admin.layouts.app')

@section('panel')

<!-- Statistics Card -->
    <div class="col-xl-12 col-md-12 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Wallet Statistics</h4>

        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-6 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                     <img class="w-7 h-7" src="{{url('/')}}/assets/images/coins/{{$currency->image}}" width="40" alt="image">
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">${{number_format($wallet->usd,2)}}</h4>
                  <p class="card-text font-small-3 mb-0">USD Balance</p>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                     <img class="w-7 h-7" src="{{url('/')}}/assets/images/coins/{{$currency->image}}" width="40" alt="image">
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$wallet->balance}}{{$currency->symbol}}</h4>
                  <p class="card-text font-small-3 mb-0">{{$currency->symbol}} Balance</p>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    <!--/ Statistics Card -->



					<!--row opened -->
						<div class="row">

							<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="d-flex no-block align-items-center">
											<div>
												<h6 class="">Total Sent {{$currency->symbol}}</h6>
												<h3 class="m-0  text-danger">${{number_format($tsent,2)}}<br>
												<small>{{$tsentunit}}{{$currency->symbol}}</small></h3>
											</div>

										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6  col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="d-flex no-block align-items-center">
											<div>
												<h6 class="">Total Received {{$currency->symbol}}</h6>
												<h3 class="m-0 text-success">${{number_format($trec,2)}}<br>
												<small>{{$trecunit}}{{$currency->symbol}}</small>
												</h3>
											</div>

										</div>
									</div>
								</div>
							</div>

						</div>



								<div class="card">
									<div class="card-header">
										<div class="card-title">Sent {{$currency->name}} History</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example" class="table border table-bordered mb-0 text-nowrap">
												<thead>
													<tr>
														<th>TRX HASH</th>
														<th>Address</th>
														<th>Date</th>
														<th>Amount</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody class="">
												@foreach($sent as $data)
													<tr>
														<td>{{__(str_limit($data->hash, 10))}}.....<br>
														<a  target="_blank"  href="{{$data->explorer_url}}"  style="background-color: {{$general->bclr}}" class="badge badge-primary">View More</a></td>
														<td><img src="{{url('/')}}/back/images/crypto-currencies/round-outline/{{$currency->image}}"  class="w-5 h-5 mr-3" alt="">{{$data->to_address}}</td>
														<td>{{date(' d M, Y ', strtotime($data->created_at))}}<br>
														<small>{{date('h:i A', strtotime($data->created_at))}}</small></td>
														<td class="text-danger">{{$data->amount}} {{$currency->symbol}}<br>
														<small>{{number_format($data->usd,2)}} USD</small></td>
														<td><span class="badge badge-success-light fs-12">completed</span></td>
													</tr>
												@endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>




								<div class="card">
									<div class="card-header">
										<div class="card-title">Received {{$currency->name}} History</div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table id="example-2" class="table border table-bordered mb-0 text-nowrap">
												<thead>
													<tr>
														<th>TRX HASH</th>
														<th>Date</th>
														<th>Amount</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody class="">
												@foreach($received as $data)
													<tr>
														<td>{{__(str_limit($data->hash, 10))}}.....<br>
														<a  target="_blank"  href="{{$data->explorer_url}}"  style="background-color: {{$general->bclr}}" class="badge badge-primary">View More</a></td>
														<td>{{date(' d M, Y ', strtotime($data->created_at))}}<br>
														<small>{{date('h:i A', strtotime($data->created_at))}}</small></td>
														<td class="text-success">{{$data->amount}} {{$currency->symbol}}<br>
														<small>{{number_format($data->usd,2)}} USD</small></td>
														<td><span class="badge badge-success-light fs-12">Coompleted</span></td>
													</tr>
												@endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row closed -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>
@endsection


