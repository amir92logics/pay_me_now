@extends('admin.layouts.app')

@push('breadcrumb-top-right')
    <a href="{{ route('admin.withdraw.method.create') }}" class="btn btn-sm btn-primary text--small px-1 rounded-pill">
        <i data-feather='plus-circle'></i> @lang('Create new')
    </a>
@endpush

@section('panel')
    <!-- Wishlist Starts -->
    <section id="wishlist" class="row wishlist-items">
        @forelse($methods as $method)
            <div class="col-sm-6 col-md-4 col-lg-2">
                <div class="card ecommerce-card">
                    <div class="item-img text-center">
                        <a href="#">
                            <img src="{{ getImage(imagePath()['withdraw']['method']['path'].'/'. $method->image,imagePath()['withdraw']['method']['size'])}}" class="img-fluid" alt="img-placeholder" />
                        </a>
                    </div>
                    <div class="card-body p-1">
                        <div class="item-name">
                            <a href="javascript:void(0)" class="text-dark">{{ __($method->name) }} </a>
                        </div>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @if ($method->status == 0)
                        <button type="button" class="btn btn-danger btn-sm text-xs action-button btn-{{ $method->id }}" data-id="{{ $method->id }}" data-url="{{ route('admin.withdraw.method.status', $method->id) }}">{{ __('Deactive') }}</button>
                        @else
                        <button type="button" class="btn btn-success btn-sm text-xs action-button btn-{{ $method->id }}" data-id="{{ $method->id }}" data-url="{{ route('admin.withdraw.method.status', $method->id) }}"> {{ __('Active') }}</button>
                        @endif
                        <a type="button" href="{{ route('admin.withdraw.method.edit', $method->id)}}" class="btn btn-primary btn-sm text-xs">
                            <i data-feather="edit"></i> @lang('Edit')
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td class="text-muted text-center" colspan="100%">{{ __('No method has been founds.') }}</td>
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
