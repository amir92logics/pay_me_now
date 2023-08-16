    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/components.min.php?color=' . $general->base_color . '&secondColor=' . $general->secondary_color) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/css/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/css/custom.css') }}">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/pages/dashboard-ecommerce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/plugins/charts/chart-apex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/plugins/extensions/ext-component-toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/vendors/css/forms/select/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset($activeTemplateTrue . 'app-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/color.php?color=' . $general->base_color . '&secondColor=' . $general->secondary_color) }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/css/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/css/font-awesome.min.css') }}">
    @stack('style-lib')
    @stack('style')
