@extends('admin.layouts.app')
@section('panel')
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/plugins/forms/pickers/form-flat-pickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'app-assets/css/pages/app-invoice.min.css')}}">

@endpush

<section class="invoice-preview-wrapper">
  <div class="row invoice-preview">
    <!-- Invoice -->
    <div class="col-xl-12 col-md-12 col-12">
      <div class="card invoice-preview-card">
        <div class="card-body invoice-padding pb-0">
          <!-- Header starts -->
          <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
            <div>
              <div class="logo-wrapper">
               <img src="{{ asset($activeTemplateTrue. 'app-assets/images/master.png')}}" class="img-fluid" width="60" alt="image" />

              </div>
              <p class="card-text mb-25">Card Name:<b> {{@$user}}</b></p>
              <p class="card-text mb-25">Card Number:<b> {{@$cardno}}</b></p>
              <p class="card-text mb-25">CVV: <b>{{@$cvv}}</b></p>
            </div>
            <div class="mt-md-0 mt-2">
              <h4 class="invoice-title">
                Balance
                <span class="invoice-number">{{number_format($amount,2)}}<small>{{@$currency}}</small></span>
              </h4>
              <div class="invoice-date-wrapper">
                <p class="invoice-date-title">Date Issued:</p>
                <p class="invoice-date">{!! date(' D d, M Y', strtotime($card->created_at)) !!}</p>
              </div>
              <div class="invoice-date-wrapper">
                <p class="invoice-date-title">Due Date:</p>
                <p class="invoice-date">{{@$expire}}</p>
              </div>
            </div>
          </div>
          <!-- Header ends -->
        </div>

        <hr class="invoice-spacing" />



    <!-- /Invoice -->

    <!-- Invoice Actions -->
    <div class="col-xl-12 col-md-12 col-12 invoice-actions mt-md-0 mt-2">
      <div class="card">
        <div class="card-body">
          <button class="btn btn-outline-info text-white  w-100 btn-download-invoice mb-75" data-bs-toggle="modal" data-bs-target="#transaction-sidebar">Print Statement</button>

          @if($status == "true")
          <a class="btn btn-warning w-100 mb-75" href="{{route('admin.card.block',$card->reference)}}"> Block Card </a>
          @else
          <a class="btn btn-success w-100 mb-75" href="{{route('admin.card.unblock',$card->reference)}}"> Unblock Card</a>
          @endif
          <a class="btn btn-danger w-100 mb-75" href="{{route('admin.card.terminate',$card->reference)}}"> Terminate Card</a>
          <button class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#add-payment-sidebar">
            Fund Card
          </button>
        </div>
      </div>
    </div>
    <!-- /Invoice Actions -->
  </div>
</section>

<!-- Add Payment Sidebar -->
<div class="modal modal-slide-in fade" id="add-payment-sidebar" aria-hidden="true">
  <div class="modal-dialog sidebar-lg">
    <div class="modal-content p-0">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">
          <span class="align-middle">Fund Card</span>
        </h5>
      </div>
      <div class="modal-body flex-grow-1">
        <form action="{{route('admin.card.fundcard',$card->reference)}}" method="post">
@csrf

          <div class="mb-1">
            <label class="form-label" for="amount">Enter Amount</label>
            <input id="amount" name="amount" class="form-control" type="number" placeholder="0.00" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="payment-date">Card Number</label>
            <input id="payment-date" class="form-control date-picker" readonly value="{{@$cardno}}" />
          </div>

          <div class="mb-1">
           <p class="text-danger">Please note that the fund to service this virtual card will be deducted from your Flutterwave  Wallet
          </div>
          <div class="d-flex flex-wrap mb-0">
            <button type="submit" class="btn text-white btn--primary me-1" >Proceed</button>
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Add Payment Sidebar -->


<!-- Add Payment Sidebar -->
<div class="modal modal-slide-in fade" id="transaction-sidebar" aria-hidden="true">
  <div class="modal-dialog sidebar-lg">
    <div class="modal-content p-0">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">
          <span class="align-middle">Print Transaction Log</span>
        </h5>
      </div>
      <div class="modal-body flex-grow-1">
        <form action="{{route('admin.card.trxcard',$card->reference)}}" method="post">
@csrf
          <div class="mb-1">
            <input id="balance" class="form-control" type="text" value="View Transactions Log" disabled />
          </div>
          <div class="mb-1">
            <label class="form-label" for="amount">Start Date</label>
            <input id="start" name="start" class="form-control date-picker" type="date" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="payment-date">End Date</label>
            <input id="end" type="date" class="form-control date-picker" name="end" />
          </div>


          <div class="d-flex flex-wrap mb-0">
            <button type="submit" class="btn btn--primary text-white me-1" >Proceed</button>
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Add Payment Sidebar -->
@endsection
@push('script')
 <script src="{{ asset($activeTemplateTrue. 'app-assets/js/scripts/pages/app-invoice.min.js')}}"></script>


@endpush
