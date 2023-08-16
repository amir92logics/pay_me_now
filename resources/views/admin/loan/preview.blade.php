@extends('admin.layouts.app')
@section('panel')
<!-- Basic Tables start -->

<!-- Basic table -->
<div class="row" id="basic-datatable">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$pageTitle}}</h4>
                <a href="{{ route('admin.loan.request') }}" class="float-right btn btn-primary">
                    Back
                </a>
            </div>
            @forelse ($loan->attributes as $attribute)
            @if ($attribute->data_type == 'image')
            <img class="img-fluid py-3 px-2" src="/core/public/loan_attachment/{{ $attribute->data_value }}" alt="Loan Attachment">
            @else

            @endif
            @empty

            @endforelse
        </div>
    </div>
</div>
</div>


@endsection