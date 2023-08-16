@extends('admin.layouts.app')

@section('panel')

 <!-- Product Details starts -->
    <div class="card-body card">
      <div class="row my-2">
        <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
          <div class="d-flex align-items-center justify-content-center">
            <img
              src="{{ @getImage(imagePath()['profile']['user']['path'].'/'. $kyc->front,imagePath()['profile']['user']['size']) }}"
              class="img-fluid product-img"
              alt="product image"
            />
          </div>
        </div>
        <div class="col-12 col-md-7">
        @php $user = App\Models\User::whereId($kyc->user_id)->first(); @endphp


          <h4>Customer: {{ @$user->firstname }} {{ @$user->lastname }}</h4>
          <span class="card-text item-company">Username <a href="{{ route('admin.users.detail', $kyc->user_id) }}" class="customer-name">{{ @$user->username }}</a></span>

          <ul class="product-features list-unstyled">
             <h6 class="font-weight-semibold">KYC Address</h6>
													<p class="text-muted">{{$kyc->address}}, {{$kyc->city}}, {{$kyc->state}}, {{$kyc->country}}. ({{$kyc->zip}})</p>
													<dl class="product-gallery-data1">
														<dt>ID Type</dt>
														<dd>{{$kyc->type}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>ID Expiry Date</dt>
														<dd>{{$kyc->expiry}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>ID Number</dt>
														<dd>{{$kyc->number ?? ''}}</dd>
													</dl>
													<dl class="product-gallery-data1">
														<dt>Uploaded</dt>
														<dd>{{date(' d M, Y ', strtotime($kyc->created_at))}} {{date('h:i A', strtotime($kyc->created_at))}}</dd>
													</dl>
          </ul>
          <hr />
          <div class="product-color-options">
            <h6>Status</h6>
           @if($kyc->status == 1)
																<a href="#"><i class="badge bg-success">Verified</i></a>
																@else
																<a href="#"><i class="badge bg-warning">Unverified</i></a>
														@endif
            </ul>
          </div>
          <hr />
          <div class="d-flex flex-column flex-sm-row pt-1">

           @if($kyc->status == 0)
													        <a href="{{route('admin.users.verifykyc',$kyc->id)}}" class="btn btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0" data-toggle="tooltip" data-original-title="Verify"><i class="fa fa-check"></i> Approve</a>

															<a href="{{route('admin.users.declinekyc',$kyc->id)}}" class="btn btn-danger btn-sm mb-2 mb-xl-0 text-white" data-toggle="tooltip" data-original-title="Decline"><i class="fa fa-trash-o"></i>Decline</a>
															 @elseif($kyc->status == 2 || $kyc->status == 0)
															<a href="{{route('admin.users.verifykyc',$kyc->id)}}" class="btn btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0" data-toggle="tooltip" data-original-title="Verify"><i class="fa fa-check"></i> Approve</a>
															 @endif



          </div>
        </div>
      </div>
    </div>
    <!-- Product Details ends -->



						</div></div></div>

@endsection
