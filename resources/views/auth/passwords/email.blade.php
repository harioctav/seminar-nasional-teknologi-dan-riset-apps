{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.guest')
@section('title', trans('Ubah Kata Sandi'))
@section('content')
<div class="hero-static d-flex align-items-center">
  <div class="w-100">
    <!-- Reminder Section -->
    <div class="bg-body-extra-light">
      <div class="content content-full">
        <div class="row g-0 justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-4 py-4 px-4 px-lg-5">
            <!-- Header -->
            <div class="text-center">
              <p class="mb-2">
                <img class="img-avatar" src="{{ asset('assets/images/polikami.png') }}" alt="">
              </p>
              <h1 class="h4 mb-1">
                {{ trans('Lupa Kata Sandi') }}
              </h1>
              <p class="fw-medium text-muted mb-3">
                {{ trans('Harap berikan email atau nama pengguna akun Anda dan kami akan mengirimkan kata sandi Anda.') }}
              </p>
            </div>
            <!-- END Header -->

            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <!-- Reminder Form -->
            <form method="POST" action="{{ route('password.email') }}" onsubmit="return disableSubmitButton()">
              @csrf

              <div class="py-3">
                <div class="mb-4">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-control-lg form-control-alt" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ trans('Alamat Email') }}">
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="mb-4">
                <button type="submit" class="btn w-100 btn-primary" id="submit-button">
                  <i class="fa fa-fw fa-envelope me-1"></i>
                  {{ trans('Send Password Reset Link') }}
                </button>
              </div>

            </form>
            <!-- END Reminder Form -->

            <div class="text-center">
              <a class="fs-sm fw-medium" href="{{ route('login') }}">{{ trans('Masuk Aplikasi?') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END Reminder Section -->

    <!-- Footer -->
    <div class="fs-sm text-center text-muted py-3">
      <strong>{{ config('app.name') }}</strong> &copy; <span data-toggle="year-copy"></span>
    </div>
    <!-- END Footer -->

  </div>
</div>
@endsection