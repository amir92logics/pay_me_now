<link rel="stylesheet" href="{{ asset('assets/global/css/iziToast.min.css') }}">
<script src="{{ asset('assets/global/js/iziToast.min.js') }}"></script>
@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script>
            toastr.{{ $msg[0] }}("{{ __($msg[1]) }}","👋 Hello!!!");
        </script>
    @endforeach
@endif

@if ($errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        //"use strict";
        @foreach ($errors as $error)
        toastr.error("{{ __($error) }}","👋 OOPS!!!!");

      /*  iziToast.error({
            message: '{{ __($error) }}',
            position: "topRight"
        });*/
        @endforeach
    </script>

@endif
<script>
    function notify(status,message) {
        iziToast[status]({
            message: message,
            position: "topRight"
        });
    }
</script>
