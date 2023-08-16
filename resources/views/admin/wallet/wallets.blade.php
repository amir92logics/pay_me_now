@extends('admin.layouts.app')

@section('panel')
<!-- row opened -->
 <!-- Statistics Card -->
    <div class="col-xl-12 col-md-12 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Wallet Statistics</h4>

        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                     <img class="w-7 h-7" src="{{url('/')}}/assets/images/coins/{{$currency->image}}" width="40" alt="image">
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">${{number_format($usd,2)}}</h4>
                  <p class="card-text font-small-3 mb-0"> Balance USD</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                     <img class="w-7 h-7" src="{{url('/')}}/assets/images/coins/{{$currency->image}}" width="40" alt="image">
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$unit}}{{$currency->symbol}}</h4>
                  <p class="card-text font-small-3 mb-0">Balance {{$currency->symbol}}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <img class="w-7 h-7" src="{{url('/')}}/assets/images/coins/{{$currency->image}}" width="40" alt="image">
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">1{{$currency->symbol}} = ${{number_format( $rate)}}</h4>
                  <p class="card-text font-small-3 mb-0">{{$currency->symbol}} Rate</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!--/ Statistics Card -->


						<!-- row closed -->
                        <button data-bs-toggle="modal" data-bs-target="#modal-createwallet" class="btn btn-sm text-white btn--primary">Create Wallet</button><br><br>
						<!-- row opened -->
						<div class="row">

						@foreach($wallets as $data)
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card wallet">
									<div class="card-body">
										<h4 class="card-title">{{$currency->name}} Wallet</h4>

										<label>Wallet Address</label>@if($data->status == 0)
											<a class="badge badge-danger text-white">Inactive</a>
											@else
											<a class="badge badge-success text-white">Active</a>
											@endif
										<div class="input-group mb-3">
											<input type="text" class="form-control" readonly id="{{$data->label}}" value="{{$data->address}}">

										</div>

										<div class="row">
											<div class="col-xl-8 col-md-8 col-lg-8 col-sm-12 mt-2">
												<p class="mb-2 d-flex">
													<span class=""><i class="ti ti-user text-muted mr-2 mt-1 fs-16"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Wallet Owner </span> : <span class="ml-auto h5 text-primary">{{App\Models\User::whereId($data->user_id)->first()->username ?? "Unknown"}}</span>
												</p>
												<p class="mb-2 d-flex">
													<span class=""><i class="ti ti-receipt text-muted mr-2 mt-1 fs-16"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Wallet Label </span> : <span class="ml-auto h5 text-primary">{{$data->label}}</span>
												</p>
												<p class="mb-2 d-flex">
													<span class=""><i class="ti ti-wallet mr-2 fs-16 text-muted"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Wallet Balance </span> : <span class="ml-auto h5 text-primary">{{number_format($data->usd/ $rate,8)}}{{$currency->symbol}}</span>
												</p>
												<p class="mb-0 d-flex">
													<span class=""><i class="fa fa-usd mr-2 fs-16 text-muted"></i></span>
													<span class="fs-15 font-weight-normal text-muted mr-2">Total Balance </span> : <span class="ml-auto font-weight-bold text-primary">{{number_format($data->usd,2)}}USD</span>
												</p>

											</div>
											<div class="col-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">

												<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{$currency->name.':'.$data->address}}&choe=UTF-8\" style='width:100px;'  />
											</div>
										</div>
										<div class="flex mt-4">

											<a href="{{ route('admin.users.detail', $data->user_id) }}" class="btn btn-info">View Owner</a>
											@if($data->status == 1)
											<a href="{{route('admin.coin.deactivatewallet',$data->address)}}" class="btn btn-danger">Deactivate</a>
											@else
											<a href="{{route('admin.coin.activatewallet',$data->address)}}" class="btn btn-success">Activate</a>
											@endif
											<a href="{{route('admin.coin.viewwalletd',$data->address)}}" class="btn btn-info">View TRX</a>
											<button data-bs-toggle="modal"   data-bs-target="#modal-debit{{$data->id}}"  class="btn btn-warning mr-2 text-white">Debit {{$currency->symbol}}</button>
											<button data-bs-toggle="modal"  data-bs-target="#modal-credit{{$data->id}}"  class="btn btn-primary mr-2">Credit {{$currency->symbol}}</button>
										</div>
									</div>
								</div>
							</div>


@section('script')
    <script>
        function {{$data->label}}() {
            var copyText = document.getElementById("{{$data->label}}");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            var alertStatus = "{{$general->alert}}";
            if (alertStatus == '1') {
                iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});
            } else if (alertStatus == '2') {
                toastr.success("Copied: " + copyText.value);
            }
        }
    </script>
@endsection


<script>
function credit() {
 var usd = $('#usd').val();
 var unit = usd/{{$rate}};
  document.getElementById("unit").innerHTML = "<b class='text-white'>Units: "+unit+"{{$currency->symbol}}</b>";
  document.getElementById("cunit").value = unit;



 };
</script>
<script>
function debit() {
 var usd = $('#usd2').val();
 var unit = usd/{{$rate}};
  document.getElementById("unit2").innerHTML = "<b class='text-white'>Units: "+unit+"{{$currency->symbol}}</b>";
  document.getElementById("dunit").value = unit;
 };
</script>

<!-- Send Coin Modal -->

<div class="modal fade" id="modal-credit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">

												<div class="modal-dialog "  role="document">
												<form action="{{route('admin.coin.creditwallet',$data->address)}}" method="POST">
                                                                 {{csrf_field()}}
													<div class="modal-content"  style="background-color: {{$general->bclr}}">
														<div class="modal-header">
															<h2 class="modal-title" id="modal-title-default">Send {{$currency->name}}</h2>

														</div>
														<div class="modal-body">
														<center>
														<img class="w-7 h-7" src="{{url('/')}}/assets/images/coins/{{$currency->image}}" width="100" alt="image">
														</center>

															<div class="py-3 text-center">
																<p class="text-black">Balance: {{number_format($data->usd,2)}} USD</p>
															</div>

                            <label class="text-black">Enter Amount To Credit (USD)</label>
                            <input type="number"  id="usd" onkeyup="credit()" class="form-control" name="amount" placeholder="$0.00">

                             <div class="" id="unit"></div>

                             <input id="cunit" hidden name="unit" >
                             <br><br>

                            <input type="number" class="form-control" hidden name="currency" value="{{$currency->id}}">
                            <br>





															</div>
															<div class="modal-footer">
															<button type="submit" text-white class="btn bt--success">Credit {{$currency->symbol}}</button>
															<button type="button" class="btn btn-warning  ml-auto" data-bs-dismiss="modal">Cancel</button>
														</div>
														</div>

														 </form>
													</div>
												 </div>


				<!-- Send Coin Modal End -->



<!-- Debit Coin Modal -->

<div class="modal fade" id="modal-debit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">

												<div class="modal-dialog "  role="document">
												<form action="{{route('admin.coin.debitwallet',$data->address)}}" method="POST">
                                                                 {{csrf_field()}}
													<div class="modal-content">
														<div class="modal-header">
															<h2 class="modal-title" id="modal-title-default">Send {{$currency->name}}</h2>

														</div>
														<div class="modal-body">
														<center>
														<img class="w-7 h-7" src="{{url('/')}}/assets/images/coins/{{$currency->image}}" width="100" alt="image">

														</center>

															<div class="py-3 text-center">
																<p class="text-black">Balance: {{number_format($data->usd,2)}}USD</p>
															</div>

                            <label class="text-black">Enter Amount To Debit (USD)</label>
                            <input type="number"  id="usd2" onkeyup="debit()" class="form-control" name="amount" placeholder="$0.00">

                             <div class="" id="unit2"></div>
                             <input id="dunit" hidden name="unit" >
                             <br>

                            <input type="number" class="form-control" hidden name="currency" value="{{$currency->id}}">
                            <br>





															</div>
															<div class="modal-footer">
															<button type="submit" text-white class="btn btn--success">Debit {{$currency->symbol}}</button>
															<button type="button" class="btn btn-warning  ml-auto" data-bs-dismiss="modal">Cancel</button>
														</div>
														</div>

														 </form>
													</div>
												 </div>


				<!-- Debit Coin Modal End -->


							@endforeach


						</div>
							@if(count($wallets) < 1)
                            <div class="alert alert-warning mb-0" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
			<span class="alert-inner--text"><strong>Opps!</strong> You currently dont have any wallet address at the moment. Please Click on the create wallet button above to create a new {{$currency->name}} wallet address for any customer</span>
		                    </div>
							@endif

						<!-- row closed -->
					</div>
				</div>
				<!-- App-content closed -->
			</div>

			<!-- Create Wallet Modal -->
			<div class="modal fade" id="modal-createwallet" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
												<div class="modal-dialog modal-danger" role="document">
													<div class="modal-content border-0">
														<div class="modal-body text-center">
															<img class="w-7 h-7" src="{{url('/')}}/assets/images/coins/{{$currency->image}}" width="100" alt="image">

															<div class="py-3 text-center">
																<h5>Create New {{$currency->name}} Wallet</h5>
																<p>Enter a wallet address label and select a customer to create a new {{$currency->name}} wallet address for him or her</p>
                                                                <form action="{{route('admin.coin.createwallet',$currency->symbol)}}" method="POST">
                                                                 {{csrf_field()}}
                            <label text-black>Enter Wallet Label</label>
                            <input type="text" class="form-control" name="label" placeholder="Wallet Label">
                            <br>

                            <div class="form-group mb-1">
                            <label text-black>Select Customer:</label>
							<select name="user" class="form-control">
							<option>Please Select</option>
							@foreach($user as $data)
							<option value="{{$data->id}}">{{$data->username }}</option>
							@endforeach
							</select>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn--success text-white">@lang('Create Wallet')</button>

                    </div>


                                                                 </form>

															</div>
														</div>

													</div>
												</div>
											</div>
				<!-- Create Wallet Modal End -->
@endsection
