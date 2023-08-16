@extends('admin.layouts.app')
@section('panel')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$pageTitle}}</h4>
            </div>
            <form action="{{ route('admin.notify-settings.store') }}" method="POST" class="ajaxform">
                @csrf

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Notify Title</th>
                                <th>Push Notification</th>
                                <th>Email Notification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fund Transfer</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <label class="form-check-label mb-50" for="fund-transfer1"></label>
                                        <div class="form-check form-check-primary form-switch">
                                            <input type="checkbox" name="fund_transfer_push" {{ isset($option['fund_transfer_push']) ? 'checked':'' }} class="form-check-input" id="fund-transfer1" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <label class="form-check-label mb-50" for="fund-transfer2"></label>
                                        <div class="form-check form-check-primary form-switch">
                                            <input type="checkbox" name="fund_transfer_email" {{ isset($option['fund_transfer_email']) ? 'checked':'' }} class="form-check-input" id="fund-transfer2" value="1">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                <td>Withdrawals</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <label class="form-check-label mb-50" for="withdraw-1"></label>
                                        <div class="form-check form-check-primary form-switch">
                                            <input type="checkbox" {{ isset($option['withdraw_push']) ? 'checked':'' }} name="withdraw_push" class="form-check-input" id="withdraw-1" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <label class="form-check-label mb-50" for="withdraw-2"></label>
                                        <div class="form-check form-check-primary form-switch">
                                            <input type="checkbox" {{ isset($option['withdraw_email']) ? 'checked':'' }} name="withdraw_email" class="form-check-input" id="withdraw-2" value="1">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                <td>Deposit</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <label class="form-check-label mb-50" for="deposit-1"></label>
                                        <div class="form-check form-check-primary form-switch">
                                            <input type="checkbox" {{ isset($option['deposit_push']) ? 'checked':'' }} name="deposit_push" class="form-check-input" id="deposit-1" value="1">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <label class="form-check-label mb-50" for="deposit-2"></label>
                                        <div class="form-check form-check-primary form-switch">
                                            <input type="checkbox" {{ isset($option['deposit_email']) ? 'checked':'' }} name="deposit_email" class="form-check-input" id="deposit-2" value="1">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="text-end">
                        <button class="btn btn-primary btn-sm submit-btn"><i data-feather='save'></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
