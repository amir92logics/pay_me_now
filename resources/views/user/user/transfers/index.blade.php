@extends($activeTemplate . 'layouts.dashboard')
@section('content')
<div class="row d-flex justify-content-between">
@if ($total > 0)
        <div class="col">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <h2 class="fw-bolder mt-1">{{$total}}K</h2>
                    <h6 class="card-text mb-3 text-primary">{{ __('Total Transfers') }}</h6>
                </div>
            </div>
        </div>
        @endif
@if ($completed > 0)

        <div class="col">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <h2 class="fw-bolder mt-1">{{$completed}}K</h2>
                    <h6 class="card-text mb-3 text-success">{{ __('Completed Transfers') }}</h6>
                </div>
            </div>
        </div>
        @endif
@if ($refund > 0)

        <div class="col">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <h2 class="fw-bolder mt-1">{{$refund}}K</h2>
                    <h6 class="card-text mb-3 text-info">{{ __('Refund Transfers') }}</h6>
                </div>
            </div>
        </div>
        @endif
@if ($pending > 0)

        <div class="col">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <h2 class="fw-bolder mt-1">{{$pending}}K</h2>
                    <h6 class="card-text mb-3 text-warning">{{ __('Pending Transfers') }}</h6>
                </div>
            </div>
        </div>
        @endif
@if ($cancled > 0)

        <div class="col">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <h2 class="fw-bolder mt-1">{{$cancled}}K</h2>
                    <h6 class="card-text mb-3 text-danger">{{ __('Cancled Transfers') }}</h6>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row search-table justify-content-between">
                <div class="col-sm-6 align-self-center">
                    <a type="button" href="http://multipay.test/user/transfers/create" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#send-money-modal">
                        <i data-feather='plus-circle'></i>
                        Send Money
                    </a>
                    <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#statistic">
                        <i data-feather='refresh-ccw'></i>
                        Statistics
                    </button>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#beneficiary">
                        <i data-feather='user-check'></i>
                        Beneficiary
                    </button> -->
                </div>

                <div class="col-sm-6 col-md-4 text-end">
                    <form action="{{ route('user.transfers.index') }}" class="card-header-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="TR/Email/Amount">
                            <button class="btn btn-primary" id="button-addon2"><i data-feather='search'></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($transfers->count() > 0)
        @foreach ($transfers as $transfer)
            <div class="row transfers-list">
                <div class="col-12">
                    <div class="card bg-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 align-self-center">
                                    <h4 class="h4 mb-1 font-weight-bold">{{ __('TRX') }}-{{ $transfer->trx }}</h4>
                                    <p class="mb-0 font-weight-bold"><b>{{ __('From') }}</b>: {{ $transfer->sender->email }}</p>
                                    @if (auth()->id() == $transfer->sender_id)
                                        <p class="mb-0 font-weight-bold"><b>{{ __('Sent Amount') }}</b>: ${{ number_format($transfer->amount + $transfer->charge, 2) }}</p>
                                    @else
                                        <p class="mb-0 font-weight-bold<b>">{{ __('Received Amount') }}</b>:
                                            ${{ number_format($transfer->amount, 2) }}
                                        </p>
                                    @endif
                                    <p class="text-sm"><b>{{ __('Date') }}</b>:
                                        {{ Carbon\Carbon::parse($transfer->created_at)->format('Y/m/d  H:i:A') }}</p>
                                </div>
                                <div class="col-sm-4">
                                    <h4 class="h4 mb-1 font-weight-bold">{{ __('Recipient') }}</h4>
                                    <p class="mb-0">{{ __('Email') }}: {{ $transfer->email }}</p>
                                </div>
                                <div class="col-sm-3 align-self-center">
                                    @if (auth()->id() == $transfer->sender_id)
                                        <span class="badge rounded-pill bg-primary">{{ __('Charge') }}:
                                            ${{ number_format($transfer->charge) }}
                                        </span>
                                    @endif
                                    @if ($transfer->status == 3)
                                        <span class="badge rounded-pill badge-light-success"><i data-feather='check'></i> {{ __('Confirmed') }}</span>
                                    @elseif ($transfer->status == 1)
                                        <span class="badge rounded-pill badge-light-warning"><i data-feather='alert-circle'></i> {{ __('Pending') }}</span>
                                    @elseif ($transfer->status == 2)
                                        <span class="badge rounded-pill badge-light-info"><i data-feather='check'></i> {{ __('Accepted') }}</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-danger"><i data-feather='x'></i> {{ __('Canceled') }}</span>
                                    @endif
                                </div>
                                <div class="col-sm-1 align-self-center">
                                    @if (auth()->id() != $transfer->sender_id && $transfer->status == 1)
                                    <div class="dropdown">
                                        <button type="button" class="dropdown-toggle hide-arrow btn btn-flat-secondary btn-sm bg-light" data-bs-toggle="dropdown" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                        </button>
                                        <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-96px, 31px);">
                                            <a class="dropdown-item confirm-action" href="#" data-action="{{ route('user.transfers.show', [$transfer->id, 'type' => 'accept']) }}" data-method="GET" data-icon="fas fa-check">
                                                <i data-feather='check'></i>
                                                <span>{{ __('Accept') }}</span>
                                            </a>
                                            <a class="dropdown-item confirm-action" href="#" data-action="{{ route('user.transfers.show', [$transfer->id, 'type' => 'cancle']) }}" data-method="GET" data-icon="fas fa-ban">
                                                <i data-feather='alert-circle'></i>
                                                <span>{{ __('Cancel') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                    @elseif(auth()->id() == $transfer->sender_id)
                                    <span class="badge rounded-pill badge-light-warning"><i data-feather='arrow-up'></i> {{ __('Send') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row float-right mt-1">
            <div class="col float-end">
                {{ $transfers->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <br>
    @else
        <div class="row my-5 py-5">
            <div class="col text-center mt-5">
                <img src="{{ asset('assets/images/empty.svg') }}" alt="">
                <h4 class="mt-3">{{ __('No Transfer Request') }}</h4>
                <p>{{ __("We couldn't find any transfer request to this account") }}</p>
            </div>
        </div>
    @endif

    @push('modal')
    <div class="modal fade" id="send-money-modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Transfer money</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.transfers.store') }}" method="post" class="ajaxform_instant_reload" novalidate="novalidate">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 mb-1">
                                <label class="form-label">Enter receiver email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email address" required="">
                            </div>
                            <div class="col-sm-12 mb-1">
                                <label class="form-label">Enter amount</label>
                                <input type="number" step="any" class="form-control" name="amount" required="" placeholder="0.00" min="1">
                            </div>
                            <div class="col-sm-12 mb-1">
                                <label class="form-label">Enter you passowrd</label>
                                <input class="form-control" placeholder="Password" type="password" name="password" required="">
                            </div>
                            <div class="col-sm-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" name="is_beneficiary">
                                    <label class="form-check-label" for="inlineCheckbox1" class="form-label">Do you want to save this as a beneficiary</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-2 mb-1">
                            <button type="submit" class="btn btn-primary btn-sm submit-btn">
                                Transfer Money
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endpush
@endsection
