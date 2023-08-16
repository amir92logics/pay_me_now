@extends($activeTemplate.'layouts.dashboard')
@section('content')
<!-- Basic Tables start -->
<div class="row" id="basic-table">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{$pageTitle}}</h4>
      </div>
      <div class="card-body">
        <p class="card-text">
          @lang('Your Investment Log').
        </p>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>
                <th>@lang('Trx')</th>
                <th>@lang('Amount')</th>
                <th>@lang('Per Return Interest')</th>
                <th>@lang('Interest Type')</th>
                <th>@lang('Total Return')</th>
                <th>@lang('Get Return')</th>
                <th>@lang('Status')</th>
                <th>@lang('Next Return Date')</th>
              </tr>
          </thead>
          <tbody>
           @forelse($logs as $index => $data)
            <tr>
                <td data-label="@lang('Trx')">{{ $data->trx }}</td>
                <td data-label="@lang('Amount')">
                    <strong>
                        {{ showAmount($data->amount) }}
                        {{ __($general->cur_text) }}
                    </strong>
                </td>
                <td data-label="@lang('Per Return Interest')">
                    <strong>
                        {{ showAmount($data->interest_amount) }}
                        {{ __($general->cur_text) }}
                    </strong>
                </td>
                <td data-label="@lang('Interest Type')">
                    @if($data->interest_type == 0)
                        @lang('Fixed')
                    @else
                        @lang('Percent')
                    @endif
                </td>
                <td data-label="@lang('Total Return')">
                    <strong>
                        {{ $data->total_return }} @lang('Times')
                    </strong>
                </td>
                <td data-label="@lang('Get Return')">
                    <strong>
                        {{ $data->total_paid }} @lang('Times')
                    </strong>
                </td>
                <td data-label="@lang('Status')">
                    @if($data->status == 0)
                    <span class="badge rounded-pill badge-light-primary me-1">@lang('Running')</span>
                    @else
                    <span class="badge rounded-pill badge-light-success me-1">@lang('Completed')</span>
                    @endif
                </td>
                <td data-label="@lang('Next Return Date')">{{ showDateTime($data->next_return_date) }}</td>
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
<!-- Basic Tables end -->


@endsection

