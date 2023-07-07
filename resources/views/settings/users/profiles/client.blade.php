@extends('layouts.app')
@section('title', trans('Data Diri Saya'))
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

      <form action="{{ route('clients.update', $user->client->uuid) }}" method="POST" onsubmit="return disableSubmitButton()" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="first_title" class="form-label">{{ trans('Gelar Depan') }}</label>
              <input type="text" name="first_title" id="first_title" value="{{ old('first_title', $user->client->first_title) }}" class="form-control @error('first_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
              @error('first_title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="first_name" class="form-label">{{ trans('Nama Depan') }}</label>
              <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->client->first_name) }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
  
            <div class="mb-4">
              <label for="last_name" class="form-label">{{ trans('Nama Belakang') }}</label>
              <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->client->last_name) }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
  
            <div class="mb-1">
              <label for="last_title" class="form-label">{{ trans('Gelar Belakang') }}</label>
              <input type="text" name="last_title" id="last_title" value="{{ old('last_title', $user->client->last_title) }}" class="form-control @error('last_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
              @error('last_title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <span class="text-muted fs-sm fw-semibold">{{ trans('Kosongkan jika tidak atau belum memiliki gelar') }}</span>
            </div>

            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Email') }}" readonly>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
  
            <div class="mb-4">
              <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
              <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
  
            <div class="mb-4">
              <label for="gender" class="form-label">{{ trans('Pilih Jenis Kelamin') }}</label>
              <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                <option selected="selected" disabled>{{ trans('Pilih Jenis Kelamin') }}</option>
                <option value="Laki - Laki" {{ old('gender', $user->client->gender) === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
                <option value="Perempuan" {{ old('gender', $user->client->gender) === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
              </select>
              @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <input type="hidden" name="roles" id="roles" value="{{ old('roles', $user->isRoleId()) }}" class="form-control @error('roles') is-invalid @enderror" placeholder="{{ trans('Peran Pengguna') }}" readonly>

            <div class="mb-4">
              <label for="institution" class="form-label">{{ trans('Asal Institusi') }}</label>
              <input type="text" name="institution" id="institution" value="{{ old('institution', $user->client->institution) }}" class="form-control @error('institution') is-invalid @enderror" placeholder="{{ trans('Asal Institusi') }}" onkeypress="return hanyaHuruf(event)">
              @error('institution')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
  
            <div class="mb-4">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <label class="form-label">{{ trans('page.image') }}</label>
                </div>
                <div class="block-content">
                  <div class="push">
                    @isset($user->avatar)
                      <img class="img-prev img-profile-center" src="{{ $user->getAvatar() }}" alt="">
                    @else
                      <img class="img-prev img-profile-center" src="{{ asset('assets/images/default.png') }}" alt="">
                    @endisset
                  </div>
                </div>
              </div>
            </div>
  
            <input type="hidden" class="form-control" name="fotoLama" value="{{ $user->avatar }}">
  
            <div class="mb-4">
              <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
              <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
              @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
  
            <div class="mb-4">
              <label class="form-label" for="address">{{ trans('Alamat Lengkap') }}</label>
              <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="40" rows="4" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address', $user->client->address) }}</textarea>
              @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <button type="submit" class="btn w-100 btn-primary" id="submit-button">
                {{ trans('page.button.edit') }}
              </button>
            </div>

          </div>
        </div>

      </form>

    </div>
  </div>
</div>
@endsection