@extends('layouts.app')
@section('title') {{ trans('Ubah Kata Sandi') }} @endsection
@section('hero')
  <div class="bg-image" style="background-image: url({{ asset('assets/src/media/photos/photo12@2x.jpg') }});">
    <div class="bg-primary-dark-op">
      <div class="content content-full text-center">
        <div class="my-3">
          <img class="img-avatar img-avatar-thumb" src="{{ $user->getAvatar() }}" alt="">
        </div>
        <h1 class="h2 text-white mb-0">{{ $user->name }}</h1>
        <h2 class="h4 fw-normal text-white-75">
          {{ $user->isRoleName() }}
        </h2>
        <a class="btn btn-alt-secondary" href="{{ route('home') }}">
          <i class="fa fa-fw fa-arrow-left text-danger me-1"></i>
          {{ trans('Back to Dashboard') }}
        </a>
      </div>
    </div>
  </div>
@endsection
@section('content')
<div class="content content-full content-boxed">
  <div class="block block-rounded">
    <div class="block-content">

      <form action="{{ url('settings/users/password') }}" method="POST" onsubmit="return disableSubmitButton()">
        @csrf

        <h2 class="content-heading pt-0">
          <i class="fa fa-fw fa-asterisk text-muted me-1"></i>
          {{ trans('Ubah Kata Sandi') }}
        </h2>

        <div class="row push">
          <div class="col-lg-4">
            <p class="text-muted">
              {{ trans('Mengubah kata sandi masuk Anda adalah cara mudah untuk menjaga keamanan akun Anda.') }}
            </p>
          </div>
          <div class="col-lg-8 col-xl-5">

            <div class="mb-4">
              <label class="form-label" for="current_password">{{ trans('Kata Sandi Saat Ini') }}</label>
              <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
              @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="row mb-4">
              <div class="col-12">
                <label class="form-label" for="password">{{ trans('Kata Sandi Baru') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-12">
                <label class="form-label" for="password_confirmation">{{ trans('Konfirmasi Kata Sandi Baru') }}</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                @error('password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

          </div>
        </div>

        <div class="row push">
          <div class="col-lg-8 col-xl-5 offset-lg-4">
            <div class="mb-4">
              <button type="submit" class="btn btn-primary w-100" id="submit-button">
                <i class="fa fa-check-circle me-1"></i>
                {{ trans('Ubah Kata Sandi') }}
              </button>
            </div>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>
@endsection