@extends('layouts.guest')
@section('title', trans('page.login.header'))
@section('content')
<div class="row justify-content-center my-auto">
  <div class="col-md-8 col-lg-6 col-xl-5">
    <div class="card bg-transparent shadow-none border-0">
      <div class="card-body">
        <div class="py-3">
          <div class="text-center">
            <h5 class="mb-0">{{ trans('page.login.title') }}</h5>
            <p class="text-muted mt-2">{{ trans('page.login.subtitle') }}</p>
          </div>

          <form class="mt-4 pt-2" method="POST" action="{{ route('login') }}" onsubmit="return disableSubmitButton()">
            @csrf

            <div class="form-floating form-floating-custom mb-3">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" required placeholder="Masukkan email">
              <label for="email">{{ trans('Email') }}</label>
              <div class="form-floating-icon">
                <i class="uil uil-envelope-alt"></i>
              </div>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
              <input id="password-input" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi">
              <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
              </button>
              <label for="password-input">{{ trans('Kata Sandi') }}</label>
              <div class="form-floating-icon">
                <i class="uil uil-padlock"></i>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-check form-check-primary font-size-16 py-1">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              @if (Route::has('password.request'))
                <div class="float-end">
                  <a href="{{ route('password.request') }}" class="text-muted text-decoration-underline font-size-14">{{ trans('page.login.forgot') }}</a>
                </div>
              @endif
                <label class="form-check-label font-size-14" for="remember">
                  {{ trans('page.login.remember') }}
                </label>
            </div>

            <div class="mt-3">
              <button class="btn btn-primary w-100" id="submit-button" type="submit">{{ trans('page.login.title') }}</button>
            </div>

            <div class="mt-4 pt-3 text-center">
              <p class="text-muted mb-0">{{ trans('page.login.guest') }} <a href="{{ route('register') }}" class="fw-semibold text-decoration-underline">{{ trans('page.login.register_link') }}</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div> <!-- end row -->
@endsection