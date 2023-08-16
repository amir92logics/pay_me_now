<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/js/core/app-menu.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/js/core/app.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/customizer.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('assets/plugins/js/Notify.js') }}"></script>
<script src="{{ asset('assets/plugins/js/custom.js') }}"></script>
<script src="{{ asset('assets/plugins/js/toastify.js') }}"></script>
{{-- <script src="{{ asset('assets/user/js/form.js') }}"></script> --}}
@stack('script-lib')

@stack('script')

@include('partials.plugins')

@include('partials.notify')

@if(session('success'))
    <script>
        Notify('success', null, '{{ Session::get('success') }}')
    </script>
@endif

@if(Session::has('warning'))
    <script>
        Notify('warning', null, '{{ Session::get('warning') }}')
    </script>
@endif

@if(Session::has('error'))
    <script>
        Notify('error', null, '{{ Session::get('error') }}')
    </script>
@endif

<script>
    (function($) {
        "use strict";
        $(".langSel").on("change", function() {
            window.location.href = "{{ route('home') }}/change/" + $(this).val();
        });

    })(jQuery);
</script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
