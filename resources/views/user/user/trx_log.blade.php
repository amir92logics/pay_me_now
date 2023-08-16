@extends($activeTemplate.'layouts.dashboard')
@section('content')

<section id="dashboard-ecommerce">
  <div class="row match-height">

    <div class="row" id="basic-table">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('user.trx.report') }}" class="btn btn-primary">@lang('Send Report')</a>
          </div>
          <div class="table-responsive">
            <table class="table custom--table">
              <thead>
                <tr>
                  <th>@lang('Trx')</th>
                  <th>@lang('Date')</th>
                  <th>@lang('Amount')</th>
                  <th>@lang('Charge')</th>
                  <th>@lang('Post Balance')</th>
                  <th>@lang('Detail')</th>
                </tr>
              </thead>
              <tbody>

                @forelse($logs as $index => $data)
                <tr>
                  <td data-label="@lang('Trx')">{{ $data->trx }}</td>
                  <td data-label="@lang('Transacted')">
                    {{ showDateTime($data->created_at) }}
                  </td>
                  <td data-label="@lang('Amount')">
                    <strong @if($data->trx_type == '-') class="text-danger" @else class="text-success" @endif>
                      {{ $data->trx_type }}
                      {{ showAmount($data->amount) }}
                      {{ __($general->cur_text) }}
                    </strong>
                  </td>
                  <td data-label="@lang('Trx')" class="text-danger">{{ showAmount($data->charge) }} {{ __($general->cur_text) }}</td>
                  <td data-label="@lang('Post Balance')">
                    <strong>
                      {{ showAmount($data->post_balance) }}
                      {{ __($general->cur_text) }}
                    </strong>
                  </td>
                  <td data-label="@lang('Detail')">{{ __($data->details) }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="100%">{{ __($emptyMessage) }}</td>
                </tr>
                @endforelse

              </tbody>
            </table>
          </div>

          {{$logs->links()}}

        </div>
      </div>
    </div>

  </div>

  </div>




  @endsection