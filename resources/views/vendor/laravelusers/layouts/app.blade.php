<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ config('app.name', 'Laravel') }}</title>

        {{-- Styles --}}
        @if(config('laravelusers.enableBootstrapCssCdn'))
            <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.bootstrapCssCdn') }}">
        @endif
        @if(config('laravelusers.enableAppCss'))
            <link rel="stylesheet" type="text/css" href="{{ asset(config('laravelusers.appCssPublicFile')) }}">
        @endif

        @yield('template_linked_css')

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <style>
            .navbar-brand {
                margin-right: auto !important;
            }
            .nav-item {
                margin-left: 15px;
            }
            /* Add padding to body to prevent content hiding */
            body {
                padding-top: 80px;
            }
            /* Fixed navbar styling */
            .fixed-nav {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                z-index: 1030;
            }
        </style>
    </head>
    <body>
    <!-- Fixed Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <!-- Logo Section -->
            <a class="navbar-brand" href="#">

                إدارة المستخدمين
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <!-- Dashboard Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">لوحة التحكم</a>
                    </li>

                    <!-- Logout Button -->
                    <li class="nav-item">
                        <button class="btn btn-outline-danger">تسجيل الخروج</button>
                    </li>


                </ul>
            </div>
        </div>
    </nav>

        <div class="container-fluid">
            @yield('content')
        </div>

        {{-- Scripts --}}
        @if(config('laravelusers.enablejQueryCdn'))
            <script src="{{ asset(config('laravelusers.jQueryCdn')) }}"></script>
        @endif
        @if(config('laravelusers.enableBootstrapPopperJsCdn'))
            <script src="{{ asset(config('laravelusers.bootstrapPopperJsCdn')) }}"></script>
        @endif
        @if(config('laravelusers.enableBootstrapJsCdn'))
            <script src="{{ asset(config('laravelusers.bootstrapJsCdn')) }}"></script>
        @endif
        @if(config('laravelusers.enableAppJs'))
            <script src="{{ asset(config('laravelusers.appJsPublicFile')) }}"></script>
        @endif
        @include('laravelusers::scripts.toggleText')

        @yield('template_scripts')

    </body>
</html>
