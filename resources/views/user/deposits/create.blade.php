@extends($activeTemplate.'layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-body">
        <a href="" class="btn btn-primary btn-sm mb-3"><i data-feather='link'></i> Link Your Account</a>
        <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-justified" data-bs-toggle="tab" href="#home-just" role="tab" aria-controls="home-just" aria-selected="true"><i data-feather='send'></i> Deposit by bank transfer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="messages-tab-justified" data-bs-toggle="tab" href="#messages-just" role="tab" aria-controls="messages-just" aria-selected="false"><i data-feather='credit-card'></i> Deposit by cheque</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab-justified" data-bs-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="true"><i data-feather='dollar-sign'></i> Deposit by cash</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content pt-1">
            <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
                <h4>Bank Transfer Details</h4>
                <form action="{{ route('user.deposits.store') }}" method="post" class="ajaxform_instant_reload">
                    @csrf

                    <div class="alert alert-danger mt-2" role="alert">
                        <div class="alert-body"><i data-feather='alert-triangle'></i> Please upload your proof of payment. Our customers care representative will facilitate your transfer once it has been confirmed.</div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-sm-12 mb-1">
                            <label for="bank_id">Select Bank</label>
                            <select name="bank_id" onchange="myFunction()" class="form-control" id="bank_id">
                                <option value="">-Select a Bank-</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}" data-id="{{ $bank->id }}" data-resource="{{ $bank }}"
                                            data-account_name="{{ $bank->account_name}}"
                                            data-bank_name="{{$bank->name }}"
                                            data-charge="{{ $bank->charge }}"
                                            data-account_number="{{$bank->account_no }}"
                                            data-code="{{$bank->code }}"
                                            data-desc="{{$bank->description }}"
                                            >{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="bank_name">Bank Name</label>
                                <input type="text" readonly name="bank_name" id="bank_name" class="form-control"
                                    placeholder="" />
                            </div>
                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="account_name">Account Name</label>
                                <input type="text" readonly name="account_name" id="account_name" class="form-control"
                                    placeholder="" />
                            </div>
                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="charge">Charge</label>
                                <input type="text" readonly name="charge" id="charge" class="form-control"
                                    placeholder="0.00" />
                            </div>
                            <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="account_number">Account Number</label>
                                <input type="text" readonly name="account_number" id="account_number" class="form-control"
                                    placeholder="" />
                            </div>
                             <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="code">Sort Code</label>
                                <input type="text" readonly name="code" id="code" class="form-control"
                                    placeholder="" />
                            </div>
                             <div class="mb-1 form-password-toggle col-md-6">
                                <label class="form-label" for="desc">Description</label>
                                <textarea  readonly name="desc" id="desc" class="form-control"
                                    placeholder="" ></textarea>
                            </div>
                        <div class="col-sm-6 mb-1">
                            <label for="account_no">Bank Account No.</label>
                            <input type="text" name="account_no" id="account_no" class="form-control" placeholder="Enter your account number" required>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <label for="account_no">Deposit Amount</label>
                            <input type="hidden" name="type" value="bank_transfer">
                            <input type="number" step="any" name="amount" id="amount" class="form-control" placeholder="Enter deposit amount" required>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <label for="proof">Authorization</label>
                            <input type="file" name="proof" id="proof" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mb-1">
                            <label for="proof">Notes</label>
                            <textarea name="notes" id="notes" class="form-control" placeholder="Enter your notes"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-primary btn-sm submit-btn"><i data-feather='save'></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="messages-just" role="tabpanel" aria-labelledby="messages-tab-justified">
                <div class="alert alert-danger alert-dismissible fade show p-1" role="alert">
                    <strong>Please read!</strong> What are funds available? Generally, Deposits made after 6pm PT or on weekends and holidays will post at the end of the next business day and funds will typically be available on the morning of the second business day. How much can i deposit? The current limit for mobile check deposit is $5,000 or 10 deposits per day and $10,000 or 50 deposits per week. If you have reached your limit, visit our cash deposit store.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <form action="{{ route('user.deposits.store') }}" method="post" class="ajaxform_instant_reload">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12 mb-1">
                            <label for="amount">Enter Amount</label>
                            <input type="number" step="any" name="amount" id="amount" placeholder="Please enter the deposit amount" class="form-control" required>
                            <input type="hidden" name="type" value="cheque">
                        </div>
                        <div class="col-sm-6 mb-1">
                            <label for="front_cheque">Front of cheque</label>
                            <input type="file" name="front_cheque" id="front_cheque" class="form-control" accept="image/jpeg, image/png" onchange="frontPreview(this);" required>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <label for="back_cheque">Back of cheque</label>
                            <input type="file" name="back_cheque" id="back_cheque" class="form-control" accept="image/jpeg, image/png" onchange="backPreview(this);" required>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <img height="150px" width="100%" src="" alt="" class="frontPreviewImg d-none">
                        </div>
                        <div class="col-sm-6 mb-1">
                            <img height="150px" width="100%" src="" alt="" class="backPreviewImg d-none">
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-primary btn-sm submit-btn"><i data-feather='save'></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
                <div class="border p-2 mb-3">
                    {!! $cash_deposite !!}
                </div>

                <form action="{{ route('user.deposits.store') }}" method="post" class="ajaxform_instant_reload">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12 mb-1">
                            <label for="amount">Enter Amount</label>
                            <input type="number" step="any" name="amount" id="amount" placeholder="Please enter the deposit amount" class="form-control" required>
                            <input type="hidden" name="type" value="cash_deposit">
                        </div>
                        <div class="col-sm-12 mb-1">
                            <label for="proof">Notes</label>
                            <textarea name="notes" id="notes" class="form-control" placeholder="Enter your notes"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-primary btn-sm submit-btn"><i data-feather='save'></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
@endsection

@push('script')
    <script>
         function myFunction() {
            var bank_id = $("#bank_id option:selected").attr('data-id');
            var bank_name = $("#bank_id option:selected").attr('data-bank_name');
            var account_number = $("#bank_id option:selected").attr('data-account_number');
            var account_name = $("#bank_id option:selected").attr('data-account_name');
            var charge = $("#bank_id option:selected").attr('data-charge');
            var code = $("#bank_id option:selected").attr('data-code');
            var desc = $("#bank_id option:selected").attr('data-desc');
            document.getElementById("bank_name").value = bank_name;
            document.getElementById("account_number").value = account_number;
            document.getElementById("account_name").value = account_name;
            document.getElementById("charge").value = charge;
            document.getElementById("code").value = code;
            document.getElementById("desc").value = desc;
         }
        function frontPreview(input){
            var file = $("#front_cheque").get(0).files[0];
            if(file){
                var reader = new FileReader();
                $('.frontPreviewImg').removeClass('d-none')
                reader.onload = function(){
                    $(".frontPreviewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
        function backPreview(input){
            var file = $("#back_cheque").get(0).files[0];
            if(file){
                var reader = new FileReader();
                $('.backPreviewImg').removeClass('d-none')
                reader.onload = function(){
                    $(".backPreviewImg").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
