@extends('admin.layouts.app')
@section('panel')
 <div class="row" id="basic-table">

                <!-- row opened -->
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Recent Swap Orders </div>
										<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table card-table table-striped text-nowrap table-bordered border-top">
												<thead>
													<tr>
														<th>ID</th>
														<th>User</th>
														<th>From</th>
														<th>Charge</th>
														<th>To</th>
														<th>Status</th>
														<th>Date</th>
													</tr>
												</thead>
												<tbody>
												@foreach($log as $data)
                                                @php $user = App\Models\User::where('id', $data->user_id)->first(); @endphp
													<tr>
														<td>#{{$data->trx}}</td> <td data-label="@lang('User')">{{ __(@$user->username ?? 'User Not Found') }}<br>
                 <a href="{{ route('admin.users.detail', @$user->id ?? '0') }}" class="btn btn-sm text-white btn--primary" data-toggle="tooltip" title="" data-original-title="@lang('Details')">
                                        View
                 </a>
                </td>
														<td>{{$data->explorer_url}}<br>
														<small><i data-feather="dollar-sign" class="avatar-icon"></i> {{number_format($data->usd,2)}}</small>
														</td>
														<td>{{$data->hash}}% <br>
														<small><i data-feather="dollar-sign" class="avatar-icon"></i>{{number_format($data->usd-$data->amount,2)}}</small>
														</td>

														<td>{{$data->wallet_id}}<br>
														<small><i data-feather="dollar-sign" class="avatar-icon"></i> {{number_format($data->amount,2)}}</s,mall>
														</td>

                                                       @if($data->status == 0)
														<td><span class="badge bg-warning badge-pill">Pending</span></td>
														@elseif($data->status == 1)
														<td><span class="badge bg-success badge-pill">Completed</span></td>
														@else
														<td><span class="badge bg-danger badge-pill">Declined</span></td>
														@endif
														<td>{{date(' d M, Y ', strtotime($data->created_at))}} {{date('h:i A', strtotime($data->created_at))}}</td>
													</tr>
											  @endforeach


												</tbody>
											</table>
											 @if(count($log) < 1)
											 <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
			<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
			<span class="alert-inner--text"> You dont have any trade at the moment</span>

		</div>

											  @endif
										</div>
									</div>
								</div>
							</div>



                </div>
            </div>
        </div>



    </div>

@endsection
