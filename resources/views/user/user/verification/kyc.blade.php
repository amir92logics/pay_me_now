@extends($activeTemplate.'layouts.dashboard')

@section('content')

<div class="row">
  <!-- Checkout Customer Address Starts -->
     <div class="col-xl-12">

        @if($kyc )
      <!-- Checkout Customer Address Right starts -->
        <div class="customer-card">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Name: {{Auth::user()->firstname.' '.Auth::user()->lastname}}</h4>
            </div>
            <div class="card-body actions">
              <p class="card-text">Document Type: {{@$kyc->type}}</p>
              <p class="card-text">Document Number: {{@$kyc->number}}</p>
              <p class="card-text">Expiry Date: {{@$kyc->expiry}}</p>
              <p class="card-text">Address: {{@$kyc->address}}</p>
              <p class="card-text">Zip: {{@$kyc->zip}}</p>
              <p class="card-text">City: {{@$kyc->city}}</p>
              <p class="card-text">State: {{@$kyc->state}}</p>
              <p class="card-text">Country: {{@$kyc->country}}</p>
              @if(@$kyc->status == 0)
              <p class="card-text text-danger"> Account Not Verified</p>
              @elseif(@$kyc->status == 1)
			  <p class="card-text text-success">Account Verified</p>
			  @else
			  <p class="card-text text-success">Verification Declined</p>
			  @endif
            </div>
          </div>
        </div>
        <!-- Checkout Customer Address Right ends -->
        @endif

   <form action="{{route('user.kycpost')}}" class="list-view product-checkout" id="checkout-address"   method="post" enctype="multipart/form-data">
   @csrf
        <!-- Checkout Customer Address Left starts -->
        <div class="card">
          <div class="card-header flex-column align-items-start">
            <h4 class="card-title">Upload KYC Document</h4>
            <p class="card-text text-muted mt-25">Be sure to check your uploaded file for validity before you upload.</p>
          </div>
          <div class="card-body">
            <div class="row">

            <div class="mb-1  col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                            <label for="city" class="text-white">@lang('Upload ID:')</label>
                             <div class="file-upload-wrapper" data-text="Select ID">
                             <input type="file" name="image" accept="image/*" type="file" class="form-control">
                            </div>
			</div>
                        </div>


              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                                              <label for="lastname" class=" text-white ">@lang('Type Of ID:')</label>
                            <select name="type" class="form-control">
@foreach($document as $data)
<option value="{{$data->type}}">{{$data->type}}</option>
@endforeach
</select>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                    <label for="phone" class="text-white">@lang('ID Number')</label>
                    <input type="text" class="form-control" name="number"  required  placeholder="Enter Number on ID" />

                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                     <label for="address" class="">@lang('Expiry Date:')</label>
                     <input type="date"  class="form-control"  required name="expiry" value="" />

                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                 <label for="state" class="">@lang('Address:')</label>
                 <input type="text" class="form-control" name="address" placeholder="Address Line 1" required   />

                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label for="zip" class="">@lang('Post Code:')</label>
                  <input type="text" class="form-control" name="zip" placeholder="Postcode"  required  />
                 </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                  <label for="city" class="">@lang('City:')</label>
                  <input type="text" class="form-control" name="city" placeholder="City"  required />
                  </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                    <label for="zip" class="">@lang('State:')</label>
                    <input type="text" class="form-control " name="state" placeholder="State"  required  />
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="mb-2">
                   <label for="city" class="">@lang('Country:')</label>
                   <input type="text" class="form-control" name="country" placeholder="Country" required   />
                 </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn--primary text-white btn-next delivery-address">Save And Upload Document</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Checkout Customer Address Left ends -->

      </form>
    </div>
    <!-- Checkout Customer Address Ends -->


						</div>
					</div>
@endsection

@push('script')

    <script src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/js/scripts/forms/pickers/form-pickers.min.js"></script>
