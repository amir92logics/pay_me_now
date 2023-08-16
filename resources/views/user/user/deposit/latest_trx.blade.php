@extends($activeTemplate.'layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{$pageTitle}}</h4>
                <p class="card-text">
                    @lang('Your Account Deposit Histroy').
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <!-- Company Table Card -->
    <div class="col-lg-12 col-12">
        <div class="card card-company-table">

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@lang('Trx')</th>
                                <th>@lang('Type')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Charge')</th>
                                <th>@lang('Detail')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestTrx as $index => $data)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div>
                                            <div class="fw-bolder">{{ $data->trx }}</div>
                                            <div class="font-small-2 text-muted">{{ showDateTime($data->created_at) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <span>@if($data->trx_type == "+") <badge class="badge rounded-pill badge-glow bg-success">Credit</badge> @else <badge class="badge rounded-pill badge-glow bg-danger">Debit</badge> @endif</span>
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bolder mb-25">{{ showAmount($data->amount) }}
                                        </span>
                                        <span class="font-small-2 text-muted"> {{ __($general->cur_text) }}</span>
                                    </div>
                                </td>
                                <td>{{ showAmount($data->charge) }} {{ __($general->cur_text) }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bolder me-1">{{ __($data->details) }}</span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="100% text-center">
                                    <section id="alerts-with-icons">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">

                                                    <div class="card-body">
                                                        <div class="demo-spacing-0">
                                                            <div class="alert alert-danger" role="alert">
                                                                <div class="alert-body d-flex align-items-center">
                                                                    <i data-feather="info" class="me-50"></i>
                                                                    <span class="text-center"> {{ __($emptyMessage) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/ Company Table Card -->
</div>


{{-- APPROVE MODAL --}}
<div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Details')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item dark-bg">@lang('Amount') : <span class="withdraw-amount fw-bold"></span></li>
                    <li class="list-group-item dark-bg">@lang('Charge') : <span class="withdraw-charge fw-bold"></span></li>
                    <li class="list-group-item dark-bg">@lang('After Charge') : <span class="withdraw-after_charge fw-bold"></span></li>
                    <li class="list-group-item dark-bg">@lang('Conversion Rate') : <span class="withdraw-rate fw-bold"></span></li>
                    <li class="list-group-item dark-bg">@lang('Payable Amount') : <span class="withdraw-payable fw-bold"></span></li>
                </ul>
                <ul class="list-group withdraw-detail mt-1">
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

{{-- Detail MODAL --}}
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Details')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="withdraw-detail"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>


@endsection



@push('script')
<script>
    (function($) {
        "use strict";
        $('.approveBtn').on('click', function() {
            var modal = $('#approveModal');
            modal.find('.withdraw-amount').text($(this).data('amount'));
            modal.find('.withdraw-charge').text($(this).data('charge'));
            modal.find('.withdraw-after_charge').text($(this).data('after_charge'));
            modal.find('.withdraw-rate').text($(this).data('rate'));
            modal.find('.withdraw-payable').text($(this).data('payable'));
            var list = [];
            var details = Object.entries($(this).data('info'));

            var ImgPath = "{{asset(imagePath()['verify']['deposit']['path'])}}/";
            var singleInfo = '';
            for (var i = 0; i < details.length; i++) {
                if (details[i][1].type == 'file') {
                    singleInfo += `<li class="list-group-item">
                                            <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <img src="${ImgPath}/${details[i][1].field_name}" alt="@lang('Image')" class="w-100">
                                        </li>`;
                } else {
                    singleInfo += `<li class="list-group-item">
                                            <span class="font-weight-bold "> ${details[i][0].replaceAll('_', " ")} </span> : <span class="font-weight-bold ml-3">${details[i][1].field_name}</span>
                                        </li>`;
                }
            }

            if (singleInfo) {
                modal.find('.withdraw-detail').html(`<br><strong class="my-3">@lang('Payment Information')</strong>  ${singleInfo}`);
            } else {
                modal.find('.withdraw-detail').html(`${singleInfo}`);
            }
            modal.modal('show');
        });

        $('.detailBtn').on('click', function() {
            var modal = $('#detailModal');
            var feedback = $(this).data('admin_feedback');
            modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
            modal.modal('show');
        });
    })(jQuery);
</script>
@endpush

@push('style')
<style>
    .list-group-item {
        background: transparent;
    }
</style>
@endpush