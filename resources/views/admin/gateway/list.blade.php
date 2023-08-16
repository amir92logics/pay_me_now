@extends('admin.layouts.app')

@section('panel')
    <!-- Wishlist Starts -->
    <section id="wishlist" class="row wishlist-items">
        @forelse($gateways->sortBy('alias') as $k=>$gateway)
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card ecommerce-card">
                    <div class="item-img text-center">
                        <a href="#">
                            <img src="{{ getImage(imagePath()['gateway']['path'] . '/' . $gateway->image, imagePath()['gateway']['size']) }}" class="img-fluid" alt="img-placeholder" />
                        </a>
                    </div>
                    <div class="card-body p-1">
                        <div class="item-name">
                            <a href="javascript:void(0)" class="text-dark">{{ __($gateway->name) }} </a>
                        </div>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @if ($gateway->status == 0)
                        <button type="button" class="btn btn-danger btn-sm text-xs action-button btn-{{ $gateway->id }}" data-id="{{ $gateway->id }}" data-url="{{ route('admin.gateway.automatic.status', $gateway->id) }}">{{ __('Deactive') }}</button>
                        @else
                        <button type="button" class="btn btn-success btn-sm text-xs action-button btn-{{ $gateway->id }}" data-id="{{ $gateway->id }}" data-url="{{ route('admin.gateway.automatic.status', $gateway->id) }}"> {{ __('Active') }}</button>
                        @endif
                        <a type="button" href="{{ route('admin.gateway.automatic.edit', $gateway->alias) }}" class="btn btn-primary btn-sm text-xs">
                            <i data-feather="edit"></i> @lang('Edit')
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td class="text-muted text-center" colspan="100%">{{ __('No gateway has been installed.') }}</td>
            </tr>
        @endforelse
    </section>
    <!-- Wishlist Ends -->
@endsection
@push('style')
    <style>
        .feather, [data-feather] {
            height: 12px;
            width: 12px;
        }

        .btn-sm {
            padding: 0.486rem 0rem;
            font-size: 10px;
            border-radius: 0;
        }
    </style>
@endpush
