<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    @include('partials.seo')
    <title>{{ $general->sitename(__($pageTitle ?? env('APP_NAME'))) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/components.min.php?color=' . $general->base_color . '&secondColor=' . $general->secondary_color) }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/themes/semi-dark-layout.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/css/jquery-confirm.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/css/toastify.css') }}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/pages/dashboard-ecommerce.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/plugins/charts/chart-apex.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/plugins/extensions/ext-component-toastr.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset($activeTemplateTrue . 'app-assets/css/pages/app-ecommerce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/forms/select/select2.min.css') }}">

    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue. 'assets/css/style.css') }}"> --}}
    <link rel="stylesheet"
        href="{{ asset($activeTemplateTrue . 'css/color.php?color=' . $general->base_color . '&secondColor=' . $general->secondary_color) }}">
    @stack('style-lib')
    @stack('style')
    <style>
        .is-invalid {
            color: red;
        }
    </style>
</head>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    @yield('content')

    <!-- Footer -->
    </div>

    </div>
    <!-- End: Customizer-->


    <!-- BEGIN: Footer-->
    <!-- <footer class="footer footer-static footer-light">
      <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT  &copy; {{ date('Y') }}<a class="ms-25" href="{{ url('/') }}" target="_blank">{{ $general->sitename }}</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer> -->
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset($activeTemplateTrue . 'app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/customizer.min.js') }}"></script>

    <script src="{{ asset($activeTemplateTrue . 'app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
    <!-- END: Theme JS-->
    <script src="{{ asset('assets/plugins/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/js/toastify.js') }}"></script>
    <script src="{{ asset('assets/plugins/js/Notify.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom/custom.js') }}"></script>
    <script src="{{ asset('assets/plugins/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')

    @if(session('success'))
    <script>
        toastr.success('{{ Session::get('success') }}');
    </script>
    @endif

    @if(Session::has('warning'))
        <script>
            toastr.warning('{{ Session::get('warning') }}');
        </script>
    @endif

    @if(Session::has('error'))
        <script>
            toastr.error('{{ Session::get('error') }}');
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

        $(document).ready(function() {
        $('#summernote').summernote();
        });
    </script>

</body>
</html>
