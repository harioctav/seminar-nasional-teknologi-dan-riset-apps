<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/polikami.png') }}">
    <!-- END Icons -->

    <!-- Dashmix framework -->
    <link rel="stylesheet" href="{{ asset('assets/custom/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/src/css/oneui.min.css') }}">
    <!-- END Stylesheets -->

  </head>

  <body>

    <div id="page-container">
      <main id="main-container">
        @yield('content')
      </main>
    </div>

    <script src="{{ asset('assets/src/js/oneui.app.min.js') }}"></script>
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>

    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="{{ asset('assets/src/js/lib/jquery.min.js') }}"></script>

    <!-- Plugin JS -->
    <script src="{{ asset('assets/src/js/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/src/js/pages/op_auth_signin.min.js') }}"></script>

    <script>
      One.helpersOnLoad([
        'jq-select2',
      ])
    </script>

    @include('sweetalert::alert')
    @include('layouts.components.alert')
    @stack('javascript')
  </body>
</html>