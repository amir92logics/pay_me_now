@extends($activeTemplate.'layouts.dashboard')


@section('content')
 
            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent align-items-center flex-wrap border-bottom">
                                    <h6 class="mb-0 fw-bold">Sell {{$coin->name}}</h6><br>
                                    <ul class="nav nav-tabs tab-body-header rounded d-inline-flex mt-2 mt-md-0" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#Limit" role="tab">SELL</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#Market" role="tab">LOG</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="Limit">
                                            <div class="row g-3">
                                                <div class="col-xl-6">
                                                    
                                                    {!!$coin->chart!!}
                                                </div>
                                                <div class="col-xl-6">
                                                <form action="" method="post">
                                                @csrf
                                                        <div class="row g-3 mb-3">
                                                            <div class="col-xl-12">
                                                                <label class="form-label">Amount To Sell</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="amount" id="usd" onkeyup="myFunction()"   placeholder="0.00USD"  class="form-control">
                                                                    <input name="sell" value="sell" hidden>
                                                                    <button class="btn btn-outline-secondary text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">USD</button>
                                                                     
                                                                </div>
                                                            </div>
                                                             
                                                            <div class="col-xl-12">
                                                                <label class="form-label">Amount In {{$coin->symbol}}</label>
                                                                <div class="input-group">
                                                                    <input type="text" id="convert" disabled placeholder="0.00000{{$coin->symbol}}" class="form-control">
                                                                    <button class="btn btn-outline-secondary  text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{$coin->symbol}}</button>
                                                                     
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-12">
                                                            <b>
                                                            <div class="d-flex flex-wrap justify-content-between mb-1">
                                                                    <div>Price</div>
                                                                    <div class="text-muted"> 1 {{$coin->symbol}} = {{number_format($coin->price,2)}} USD</div>
                                                                </div>
                                                                <div class="d-flex flex-wrap justify-content-between mb-1">
                                                                    <div>Inverse Price</div>
                                                                    <div class="text-muted"> 1 USD = {{number_format(1/$coin->price,8)}} {{$coin->symbol}}</div>
                                                                </div>
                                                                <hr>
                                                                <div class="d-flex flex-wrap justify-content-between mb-1">
                                                                    <div>Our Price</div>
                                                                    <div class="text-muted"> 1 {{$coin->symbol}} = {{number_format($coin->buy,2)}} {{$general->cur_text}}</div>
                                                                </div> 
                                                                <div class="d-flex flex-wrap justify-content-between mb-1">
                                                                    <div>Inverse Price</div>
                                                                    <div class="text-muted"> 1 USD = {{number_format(1/$coin->buy,8)}} {{$coin->symbol}}</div>
                                                                </div>
                                                                </b>
                                                                <hr>

                                                                <div class="d-flex flex-wrap justify-content-between">
                                                                    <div><b>Balance  <small>{{$coin->symbol}}</small></b></div>
                                                                  <b>  <div class="text-primary"> {{number_format($wallet->balance,8)}} <small>{{$coin->symbol}}</small></div> </b>
                                                                </div>
                                                                <div class="d-flex flex-wrap justify-content-between">
                                                                    <div><b>Balance  <small>{{$general->cur_text}}</small></b></div>
                                                                  <b>  <div class="text-primary"> {{number_format($wallet->balance/$coin->price,2)}} <small>{{$general->cur_text}}</small></div> </b>
                                                                </div>
                                                                <hr>
                                                               <b><div class="d-flex flex-wrap justify-content-between">
                                                                    <div>Transction Charge </div>
                                                                    <div class="text-danger"> {{$coin->fee}}%</div>
                                                                </div>
                                                                <div class="d-flex flex-wrap justify-content-between">
                                                                    <div>Our Charge <small> {{$general->cur_text}}</small></div>
                                                                    <div class="text-danger" id="charge"> 0.00 <small>{{$general->cur_text}}</small></div>
                                                                </div>
                                                                <div class="d-flex flex-wrap justify-content-between">
                                                                    <div>Our Charge <small>{{$coin->symbol}}</small></div>
                                                                    <div class="text-danger" id="chargecoin"> 0.00000000 <small>{{$coin->symbol}}</small></div>
                                                                </div>
                                                                <div class="d-flex flex-wrap justify-content-between">
                                                                    <div>What We Debit</div>
                                                                    <div class="text-success" id="debit"> 0.00000 {{$coin->symbol}}</div>
                                                                </div>
                                                                <div class="d-flex flex-wrap justify-content-between">
                                                                    <div>What You Receive</div>
                                                                    <div class="text-success" id="toget"> 0.00 {{$general->cur_text}}</div>
                                                                </div>
                                                                </b> 
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn flex-fill btn-light-primary btn-block py-2 fs-5 text-uppercase px-5  text-white">Sell {{$coin->name}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="Market">
                                            <div class="row g-3">
                                                <div class="col-xl-12">
                                                <div class="table-responsive" >
                                            <table  class="myProjectTable table table-hover custom-table align-middle mb-0" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Amount</th>
                                                        <th>Units</th> 
                                                        <th>Charge</th>
                                                        <th>Value</th> 
                                                        <th>Date</th> 
                                                        <th>Status</th>
                                                     </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($sells as $data)
                                                    <tr>
                                                        <td><img src="{{url('/')}}/assets/images/coins/{{$coin->image}}" width="50" alt="" class="img-fluid avatar mx-1"> <span class="text-muted">{{$coin->symbol}}</span></td>
                                                        <td><span class="color-price-up">{{number_format($data->usd,2)}}<small>{{$general->cur_text}}</small></span></td>
                                                        <td><span class="color-price-up"> {{number_format($data->amount,2)}}<small>{{$coin->symbol}}</small></span></td>
                                                        <td><small class="color-price-down">{{number_format($data->charge_fiat,2)}}<small>{{$general->cur_text}} </small>/ {{number_format($data->charge_coin,2)}}{{$coin->symbol}}</small></td>
                                                        <td><small class="color-price-up">{{number_format($data->get_fiat,2)}}<small>{{$general->cur_text}}</small> </td>
                                                        <td><b>{{date(' d M, Y ', strtotime($data->created_at))}}<small>{{date('h:i A', strtotime($data->created_at))}}</small></b></td>
                                                        <td>
                                                        @if($data->status == 0)
                                                        <badge class="badge bg-warning text-white">Pending</badge>
                                                        @elseif($data->status == 2)
                                                        <badge class="badge bg-danger text-white">Declined</badge>
                                                        @elseif($data->status == 1)
                                                        <badge class="badge bg-success text-white">Successful</badge>
                                                        @endif
                                                        </td>
                                                     </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                                 </div>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



@endsection
@push('script')  
<script>
function myFunction() {
 var amount = $('#usd').val();
 var fee = "{{$coin->fee}}";
 var convert = amount/"{{$coin->buy}}";
 var rate = "{{$coin->buy}}";
 var charge = amount/100*fee;
 var toget = amount-charge;
 var get = toget/"{{$coin->buy}}";
 var debit = (convert).toFixed(8).replace(/\d(?=(\d{3})+\.)/g, '$&,');
 var youget = (get).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
 document.getElementById("convert").value = convert;
 document.getElementById("charge").innerHTML = charge+"{{$general->cur_text}}";
 document.getElementById("toget").innerHTML = youget+"{{$general->cur_text}}";
 document.getElementById("debit").innerHTML = debit+"{{$coin->symbol}}";
 document.getElementById("chargecoin").innerHTML = charge/rate+"{{$coin->symbol}}";
 };
</script>
<script>
        // project data table
        
            $('.myProjectTable').DataTable({
                responsive: true
            });

            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
            });   
    </script>
@endpush


