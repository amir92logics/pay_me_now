@extends($activeTemplate.'layouts.frontend')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @php echo $content->data_values->details; @endphp
        </div>
    </div>
</div>

@endsection


