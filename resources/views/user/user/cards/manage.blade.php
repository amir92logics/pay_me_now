@extends($activeTemplate.'layouts.dashboard')


@section('content')

@push('style')


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/pages/app-ecommerce-details.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/forms/form-number-input.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/extensions/ext-component-toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/vendors/css/extensions/swiper.min.css')}}">

    <!-- END: Page CSS-->

    <!-- END: Page CSS-->
@endpush


<!-- Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row">

  <div class="content-header">
          <h5 class="mb-0">Create Virtual Cards</h5>
          <small class="text-muted">Please fill the form below to process your virtual credit card</small>
   </div>

   <div class="mb-1 col-md-12 red box">
            <div class="alert alert-warning" role="alert">
              <div class="alert-body"><strong>Note!</strong> Welcome to {{$general->sitename}} Virtual Card System. With our card, you can buy products online using your card details as well as make payment for services online. <br>

              Please not you will be charged a onetime service charge fee of {{$general->cur_sym}} {{$general->cardfee}} to process this card</div>
            </div>
    </div>



    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Request Form</h4>
        </div>
        <div class="card-body">
          <form action="" method="post">
@csrf
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-column">Card Type</label>
                  <select name="currency" class="form-control">
               <option value="USD">USD</option>
              </select>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="name-column">Card Name</label>
                  <input
                    type="text"
                    id="name-column"
                    class="form-control" readonly
                    value="{{Auth::user()->firstname. ' '.Auth::user()->lastname }}"
                    name="billing_name"
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="phone">Phone</label>
                  <input type="text" id="phone" class="form-control" name="mobile"  readonly value="{{Auth::user()->mobile}}" />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="mb-1">
                  <label class="form-label" for="email">Email</label>
                  <input
                    type="text"
                    id="email"
                    class="form-control"
                    name="mobile"  readonly value="{{Auth::user()->email}}"
                  />
                </div>
              </div>
              <div class="col-md-12 col-12">
                <div class="mb-1">
                  <label class="form-label" for="amount">Amount</label><br>
                  <small class="text-primary">This is the amount to prefund the card with on card creation</small>
                  <input
                    type="number"
                    id="amount"
                    class="form-control"
                    name="amount"
                    placeholder="0.00"
                  />
                </div>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn--primary text-white me-1">Proceed</button>
                <button type="reset" class="btn btn-warning">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Basic Floating Label Form section end -->

 <!-- Related Products starts -->
 <div class="card">
    <div class="card-body">
      <div class="mt-4 mb-2 text-center">
        <h4>Available Virtual Card</h4>
        <p class="card-text">Slide To View Other Cards</p>
      </div>
      <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
        <div class="swiper-wrapper">
        @foreach($card as $data)
          <div class="swiper-slide">
           <center> <a href="{{route('user.view.card',$data->reference)}}">

              <div class="img-container w-50 mx-auto py-75">
              <div class="item-heading">
                <h5 class="text-truncate mb-0">{{$data->card_type}}</h5>
                <small class="text-body">{{$data->masked_pan}}</small>
              </div>
                <img src="{{ asset($activeTemplateTrue. 'app-assets/images/master.png')}}" class="img-fluid" alt="image" />
              </div>

            </a> </center>
          </div>
        @endforeach
        @if(count($card) < 1)
        <div class="card-body">
          <div class="demo-spacing-0">
            <div class="alert alert-danger" role="alert">
              <div class="alert-body d-flex align-items-center">
                <i data-feather="info" class="me-50"></i>
                <span class="text-center"> You currently dont have any virtual card at the moment</span>
              </div>
            </div>
          </div>
        </div>
        @endif
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>    </div>
    <!-- Related Products ends -->

@endsection



@push('script')
<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/pages/app-ecommerce-details.min.js')}}"></script>
<script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/forms/form-number-input.min.js')}}"></script>
    <script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{ asset($activeTemplateTrue. 'app-assets/vendors/js/extensions/swiper.min.js')}}"></script>


@endpush

