<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/custom/css/custom.css') }}">
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <div class="auth-bg-basic d-flex align-items-center min-vh-100">
      <div class="bg-overlay bg-light"></div>
      <div class="container">
        <div class="d-flex flex-column min-vh-100 py-5 px-3">
          @yield('content')
        </div>
      </div>
      <!-- end container fluid -->
    </div>
    <!-- end authentication section -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenujs/metismenujs.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/pages/pass-addon.init.js') }}"></script>
    @include('sweetalert::alert')

  </body>
</html>