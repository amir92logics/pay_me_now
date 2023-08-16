@extends('admin.layouts.app')

@section('panel')


                <div class="card">
                    <div class="card-header">{{ __($pageTitle) }}

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="thead-dark">
                                <tr>
                                    <th>@lang('Subject')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Priority')</th>
                                    <th>@lang('Last Reply')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supports as $key => $support)
                                    <tr>
                                        <td data-label="@lang('Subject')"> <a href="{{ route('admin.user.ticket.view', $support->ticket) }}" class="font-weight-bold"> [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                                        <td data-label="@lang('Status')">
                                            @if($support->status == 0)
                                                <span class="badge bg-success badge-glow">@lang('Open')</span>
                                            @elseif($support->status == 1)
                                                <span class="badge bg-primary badge-glow">@lang('Answered')</span>
                                            @elseif($support->status == 2)
                                                <span class="badge bg-warning badge-glow">@lang('Customer Reply')</span>
                                            @elseif($support->status == 3)
                                                <span class="badge bg-dark badge-glow">@lang('Closed')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Priority')">
                                            @if($support->priority == 'Low')
                                                <badge class="badge badge-glow bg-dark">@lang('Low')</badge>
                                            @elseif($support->priority == 'Medium')
                                                <badge class="badge badge-glow bg-success">@lang('Medium')</badge>
                                            @elseif($support->priority == 'High')
                                                <badge class="badge badge-sm badge-glow bg-warning">@lang('High')</badge>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.user.ticket.view', $support->ticket) }}" class="btn text-white btn--primary btn-sm">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$supports->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
