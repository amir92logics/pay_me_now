@extends($activeTemplate.'layouts.dashboard')


@section('content')

@push('style')

@endpush

<!-- Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row">

  <div class="content-header">
          <h5 class="mb-0">{{$pageTitle}}</h5>
          <small class="text-muted">Please fill the form below to proceed with fund transfer</small>
   </div>
   <br> <br>


    <div class="col-12">
      <div class="card">
        <div class="card-header">

           <div class="demo-spacing-0">
            <div class="alert alert-warning" role="alert">
              <div class="alert-body"><strong>Hello {{Auth::user()->username}}!</strong> Please note you will be charged a transaction fee of {{$general->transferfee}}% to service this transaction</div>
            </div>
    </div>
        </div>
        <div class="card-body">
          <form action="" method="post">
@csrf
            <div class="content-header">
          <small class="text-muted">Please Transfer Type</small>
        </div>
          <div class="row">

          <div class="mb-1 col-md-12">
        <select id="first" name="type" class="form-control select-2">
            <option>Select Continent</option>
            <option value="1">Africa</option>
            <option value="2">Others</option>
        </select>
       </div>

            <div class="mb-1 col-md-12 red box">
              <label class="form-label" for="username">Select Bank</label>
              <select id="gateway" onchange="myFunction()"  class="form-control" name="bank" >
              <option disabled selected>Select A Bank</option>
             @foreach($banks as $data)
              <option data-name="{{$data['name']}}" value="{{$data['code']}}">{{$data['name']}}</option>
            @endforeach
              </select>
            <input hidden name="bankn" id="bankn">
            </div>
            @push('script')
<script>
function myFunction() {
var name = $("#gateway option:selected").attr('data-name');
document.getElementById("bankn").value = name;

 };
</script>
@endpush

            <div class="mb-1 col-md-12 red box">
              <label class="form-label" for="username">Beneficiary's Account Number</label>
              <input
                type="number"
                name="account"
                id="username"
                class="form-control"
                placeholder="Enter Account Number"
              />
            </div>


            <div class="mb-1 col-md-12 green box">
              <label class="form-label" for="bankname">Bank's Name</label>
              <input
                type="text"
                name="bankname"
                id="bankname"
                class="form-control"
                placeholder="Enter Bank Name"
              />
            </div>

            <div class="mb-1 col-md-6 green box">
              <label class="form-label" for="accountnumber">Account Number</label>
              <input
                type="number"
                name="accountnumber"
                id="accountnumber"
                class="form-control"
                placeholder="Enter Account Number"
              />
            </div>

            <div class="mb-1 col-md-6 green box">
              <label class="form-label" for="accountname">Account Name</label>
              <input
                type="text"
                name="accountname"
                id="accountname"
                class="form-control"
                placeholder="Enter Account Name"
              />
            </div>

            <div class="mb-1 col-md-6 green box">
              <label class="form-label" for="country">Country</label>
              <input
                type="text"
                name="country"
                id="country"
                class="form-control"
                placeholder="Enter Bank Country"
              />
            </div>


            <div class="mb-1 col-md-6 green box">
              <label class="form-label" for="swiftcode">Swift Code</label>
              <input
                type="text"
                name="swiftcode"
                id="swiftcode"
                class="form-control"
                placeholder="Enter Bank Swift Code"
              />
            </div>




          </div>


           <div class="row">
            <div class="mb-1 col-md-12">
              <label class="form-label" for="first-name">Amount</label>
              <input type="text" name="amount" id="amount" class="form-control" placeholder="0.00" />
            </div>
          </div>



        <div class="d-flex justify-content-between">


          <button class="btn btn-primary btn-next">
            <span class="align-middle d-sm-inline-block d-none">Transfer</span>
            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
          </button>
        </div>
      </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Basic Floating Label Form section end -->

<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <p class="card-text">
          @lang('Your Fund Transfer Log').
        </p>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
           <tr>
                <th>@lang('#')</th>
                <th>@lang('Reference')</th>
                <th>@lang('Details')</th>
                <th>@lang('Amount') & Charge</th>
                <th>@lang('Date')</th>
            </tr>
          </thead>
          <tbody>
          @php $i = 1; @endphp
            @foreach($log as $k=>$data)
            <tr>
                <td data-label="#@lang('#')">{{$i++}}</td>
                <td data-label="@lang('Ref')">{{ __($data->trx) }}<br>
                <span>@if($data->status == 1)  <badge class="badge rounded-pill badge-glow bg-success">Successful</badge><br>
                {{ __($data->reason) }}
                 @elseif($data->status == 2)  <badge class="badge rounded-pill badge-glow bg-danger badge-sm">Declined</badge>
                 @else  <badge class="badge badge-sm rounded-pill badge-glow bg-warning">Pending</badge> @endif</span>
                </td>
                <td data-label="@lang('Name')">{!!$data->details !!}</td>
                <td data-label="@lang('Amount')">{{$general->cur_sym}}{{ number_format($data->amount,2) }}<br>
                <small>{{$general->cur_sym}}{{ number_format($data->charge,2) }}</small>
                </td>

                <td data-label="@lang('Time')">
                    {!! date(' D d, M Y', strtotime($data->created_at)) !!}</h6>
              <small>{{date('h:i A', strtotime($data->created_at))}}
                </td>


            </tr>

            @endforeach

          </tbody>
        </table>
      </div>
       @if(count($log) < 1)
          <div class="demo-spacing-0">
            <div class="alert alert-danger" role="alert">
              <div class="alert-body"><strong>Hello {{Auth::user()->username}}!</strong> You dont have any fund transfer log at the moment.</div>
            </div>
          </div>
          @endif
       {{$log->links()}}
    </div>
  </div>
</div>
<!-- Basic Tables end -->

@endsection



@push('script')

<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#first").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")=="1"){
                $(".box").not(".red").hide();
                $(".red").show();
            }
            else if($(this).attr("value")=="2"){
                $(".box").not(".green").hide();
                $(".green").show();
            }
            else if($(this).attr("value")=="3"){
                $(".box").not(".blue").hide();
                $(".blue").show();
            }
            else{
                $(".box").hide();
            }
        });
    }).change();
});
</script>
@endpush

