<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/polikami.png') }}">
    <!-- END Icons -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Poppins" rel="stylesheet">
    <!-- END Fonts -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/simplemde/simplemde.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/css/oneui.min.css') }}" id="css-main">

    <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">

    @stack('css')
    <link rel="stylesheet" href="{{ asset('assets/custom/css/custom.css') }}">
    <!-- END Stylesheets -->

    <!-- Scripts -->
    @vite([])

  </head>

  <body>

    <div id="page-container" class="page-header-dark main-content-boxed">

      <!-- Header -->
      <header id="page-header">
        <!-- Header Content -->
        @include('layouts.partials.header')
        <!-- END Header Content -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-primary-lighter">
          <div class="content-header">
            <div class="w-100 text-center">
              <i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
            </div>
          </div>
        </div>
        <!-- END Header Loader -->
      </header>
      <!-- END Header -->

      <!-- Main Container -->
      <main id="main-container">
        <!-- Navigation -->
        <div class="bg-primary-darker">
          <div class="bg-black-10">
            @include('layouts.partials.navigation')
          </div>
        </div>
        <!-- END Navigation -->
        <!-- Hero -->
        <div class="bg-body-light">
          @yield('hero')
        </div>
        <!-- END Hero -->
        <!-- Page Content -->
        <div class="content">
          @yield('content')
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->

      <!-- Footer -->
      <footer id="page-footer" class="bg-body-extra-light">
        @include('layouts.partials.footer')
      </footer>
      <!-- END Footer -->
    </div>

    <!-- Dashmix JS -->
    <script src="{{ asset('assets/src/js/oneui.app.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/custom/js/custom.js') }}"></script>
    
    <!-- Plugin JS -->
    <script src="{{ asset('assets/src/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.j') }}s"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('assets/src/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    
    <!-- Page JS Code -->
    <script src="{{ asset('assets/src/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/simplemde/simplemde.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/pages/be_tables_datatables.min.js') }}"></script>
    <script src="{{ asset('assets/src/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
      One.helpersOnLoad([
        'jq-select2',
        'jq-magnific-popup',
        'jq-datepicker',
        'js-flatpickr',
        'js-ckeditor',
      ])
    </script>

    <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusherKey = "{{ env('PUSHER_APP_KEY') }}"
      var pusherCluster = "{{ env('PUSHER_APP_CLUSTER') }}"

      var pusher = new Pusher(pusherKey, {
        cluster: pusherCluster,
        authEndpoint: '/broadcasting/auth',
        auth: {
          headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
          },
        },
        // encrypted: true,
      });

      var channel = pusher.subscribe('private-admin-channel');
      channel.bind('admin-notifications', function(data) {

        One.helpers('jq-notify', {
          type: 'success', 
          icon: 'fa fa-info-circle me-1', 
          message: JSON.stringify(data.message),
        });

        $(document).ready(function() {
          setTimeout(function() {
            location.reload();
          }, 1500);
        })

      });
    </script>

    @include('sweetalert::alert')
    @stack('javascript')
    @include('layouts.components.alert')
  </body>
</html>