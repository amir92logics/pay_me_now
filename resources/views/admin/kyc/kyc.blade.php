@extends('admin.layouts.app')

@section('panel')



<!-- App-content opened -->



					<!-- row opened -->
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="card">
									<div class="card-header">
										<div class="card-title">{{$pageTitle}}</div>

									</div>
									<div class="card-body">
										<div class="table-responsive product-datatable">
											<table id="example" class="table table-striped table-bordered " >
												<thead>
													<tr>
														<th class="w-15p">Document</th>
														<th class="wd-15p">User</th>
														<th class="wd-20p">Number</th>
														<th class="wd-15p">Status</th>
														<th class="wd-10p">Action</th>
													</tr>
												</thead>
												<tbody>
												@forelse($kyc as $data)
												@php $user = App\Models\User::whereId($data->user_id)->first(); @endphp
													<tr>
														<td>
														<img src="{{ @getImage(imagePath()['profile']['user']['path'].'/'. $data->front,imagePath()['profile']['user']['size']) }}" alt="img" width="60" class="h-7 w-7">
														<p class="d-inline-block align-middle mb-0 ml-1">
															<a href="" class="d-inline-block align-middle mb-0 product-name font-weight-semibold">{{$data->type}}</a>
															<br>
															<span class="text-muted fs-13">{{date(' d M, Y ', strtotime($data->created_at))}} {{date('h:i A', strtotime($data->created_at))}}</span>
														</p>
														</td>
														<td>{{ @$user->firstname.' '.@$user->lastname }}<br>
															<span class="text-muted fs-13">{{ @$user->username}}</span></td>
														<td>{{ @$user->mobile }}</td>
														<td>
														@if($data->status == 0)
														<span class="badge bg-warning badge-md">Pending</span>
														@elseif($data->status == 1)
                                                        <span class="badge bg-success badge-md">Verified</span>
                                                        @elseif($data->status == 2)
                                                        <span class="badge bg-danger badge-md">Declined</span>
														@endif
														</td>
														<td>

															<a href="{{route('admin.users.viewkyc',$data->id)}}" class="btn btn-info btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="View Document">View</a>
														</td>
													</tr>
												 @empty
							  <div class="col-sm-12 col-md-12">
				                    <div class="alert alert-info">
					<strong>Oops</strong>
					<hr class="message-inner-separator">
					<p>{{ $empty_message }}.</p>
				                    </div>
			                   </div>

                        @endforelse

												</tbody>
											</table>
										</div>
									</div>
									<!-- table-wrapper -->
								</div>
								<!-- section-wrapper -->
							</div>
						</div>
						<!-- row closed -->

						</div></div>


@endsection
