<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', config('app.name'))" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/themes/layout/header/base/light.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/light.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/dark.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/dark.css?v=7.0.3') }}" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="{{ asset('assets/media/favicon/favicon.png') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

    @stack('before-styles')

    @stack('after-styles')
    @if (trim($__env->yieldContent('page-styles')))
        @yield('page-styles')
    @endif

</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading example">
<div id="loader"></div>

<div class="d-flex flex-column flex-root">
    @include('payment.layouts.navbar')
</div>

@stack('before-scripts')

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js?v=7.0.3') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

@include('user.layouts.components.script')

@stack('after-scripts')

@if (trim($__env->yieldContent('page-script')))
    @yield('page-script')
@endif

</body>
</html>
