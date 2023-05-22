@extends('layouts.guest')
@section('title', trans('page.login.header'))
@section('content')
<div class="hero-static d-flex align-items-center">
  <div class="w-100">
    <!-- Sign In Section -->
    <div class="bg-body-extra-light">
      <div class="content content-full">
        <div class="row g-0 justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-4 py-4 px-4 px-lg-5">
            <!-- Header -->
            <div class="text-center">
              <p class="mb-2">
                <img class="img-avatar" src="{{ asset('assets/images/polikami.png') }}" alt="">
              </p>
              <h1 class="h4 mb-1">{{ trans('page.login.title') }}</h1>
              <p class="fw-medium text-muted mb-3">{{ trans('page.login.subtitle') }}</p>
            </div>
            <!-- END Header -->

            <!-- Sign In Form -->
            <form action="{{ route('login') }}" method="POST" onsubmit="return disableSubmitButton()">
              @csrf
              
              <div class="py-3">
                <div class="mb-4">
                  <input type="text" class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <input type="password" class="form-control form-control-lg form-control-alt" id="password" name="password" required autocomplete="current-password" placeholder="Kata Sandi">
                </div>
                <div class="mb-4">
                  <div class="d-md-flex align-items-md-center justify-content-md-between">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember">{{ trans('page.login.remember') }}</label>
                    </div>
                    <div class="py-2">
                      @if (Route::has('password.request'))
                        <a class="fs-sm fw-medium" href="{{ route('password.request') }}">{{ trans('page.login.forgot') }}</a>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="mb-4">
                <button type="submit" class="btn w-100 btn-primary" id="submit-button">
                  <i class="fa fa-fw fa-sign-in-alt me-1"></i>
                  {{ trans('page.login.title') }}
                </button>
              </div>

              <div class="fs-sm text-center text-muted py-3">
                <span>{{ trans('page.login.guest') }}</span>
                <a href="{{ route('register') }}"><strong>{{ trans('page.login.register_link') }}</strong></a>
              </div>

            </form>
            <!-- END Sign In Form -->
          </div>
        </div>
      </div>
    </div>
    <!-- END Sign In Section -->

    <!-- Footer -->
    <div class="fs-sm text-center text-muted py-3">
      <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
    </div>
    <!-- END Footer -->
  </div>
</div>
@endsection