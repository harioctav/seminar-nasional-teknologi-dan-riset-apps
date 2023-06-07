<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('Jadwal Tutup') }} | {{ config('app.name') }}</title>

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/polikami.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/polikami.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/src/css/oneui.min.css') }}" id="css-main">
    <!-- END Stylesheets -->
  </head>

  <body>
    <!-- Page Container -->
    <div id="page-container">

      <!-- Main Container -->
      <main id="main-container">
        <!-- Page Content -->
        <div class="hero">
          <div class="hero-inner text-center">
            <div class="bg-body-extra-light">
              <div class="content content-full overflow-hidden">
                <div class="py-4">
                  <!-- Error Header -->
                  <h1 class="display-1 fw-bolder text-flat">
                    {{ trans('Jadwal Sedang Ditutup') }}
                  </h1>
                  <h2 class="h4 fw-normal text-muted mb-5">
                    {{ trans('Silahkan kembali lagi ketika jadwal pendaftaran sudah dibuka') }}
                  </h2>
                  <!-- END Error Header -->

                </div>
              </div>
            </div>
            <div class="content content-full text-muted fs-sm fw-medium">
              <!-- Error Footer -->
              <p class="mb-1">
                {{ trans('Terimakasih atas perhatiannya') }}
              </p>
              <a class="link-fx" href="{{ route('home') }}">{{ trans('Kembali ke dashboard') }}</a>
              <!-- END Error Footer -->
            </div>
          </div>
        </div>
        <!-- END Page Content -->
      </main>
      <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <!-- One Ui JS -->
    <script src="{{ asset('assets/src/js/oneui.app.min.js') }}"></script>
  </body>
</html>
