@extends('layouts.app')
@section('title') {{ trans('page.users.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.users.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('users.index') }}" class="btn btn-sm btn-block-option text-danger">
            <i class="fa fa-xs fa-chevron-left me-1"></i>
            {{ trans('page.button.back') }}
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.users.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('clients.update', $client->uuid) }}" method="POST" onsubmit="return disableSubmitButton()" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="first_title" class="form-label">{{ trans('Gelar Depan') }}</label>
            <input type="text" name="first_title" id="first_title" value="{{ old('first_title', $client->first_title) }}" class="form-control @error('first_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
            @error('first_title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="first_name" class="form-label">{{ trans('Nama Depan') }}</label>
            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $client->first_name) }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
            @error('first_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="last_name" class="form-label">{{ trans('Nama Belakang') }}</label>
            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $client->last_name) }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
            @error('last_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-1">
            <label for="last_title" class="form-label">{{ trans('Gelar Belakang') }}</label>
            <input type="text" name="last_title" id="last_title" value="{{ old('last_title', $client->last_title) }}" class="form-control @error('last_title') is-invalid @enderror" placeholder="{{ trans('Gelar Depan') }}" onkeypress="return hanyaHuruf(event)">
            @error('last_title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <span class="text-muted fs-sm fw-semibold">{{ trans('Kosongkan jika tidak atau belum memiliki gelar') }}</span>
          </div>

          <div class="mb-4">
            <label for="email" class="form-label">{{ trans('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ old('email', $client->user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="{{ trans('Email') }}">
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $client->user->phone) }}" class="form-control @error('phone') is-invalid @enderror" placeholder="{{ trans('Nomor Telepon') }}" onkeypress="return hanyaAngka(event)">
            @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="gender" class="form-label">{{ trans('Pilih Jenis Kelamin') }}</label>
            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
              <option selected="selected" disabled>{{ trans('Pilih Jenis Kelamin') }}</option>
              <option value="{{ Constant::MALE }}" {{ old('gender', $client->gender) === Constant::MALE ? 'selected' : '' }}>{{ Constant::MALE }}</option>
              <option value="{{ Constant::FEMALE }}" {{ old('gender', $client->gender) === Constant::FEMALE ? 'selected' : '' }}>{{ Constant::FEMALE }}</option>
            </select>
            @error('gender')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="roles" class="form-label">{{ trans('Pilih Peran') }}</label>
            <select name="roles" id="roles" class="form-select @error('roles') is-invalid @enderror">
              <option disabled selected>{{ trans('Tipe User') }}</option>
              @foreach ($roles as $item)
                @if (old('roles', $client->user->isRoleId()) == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
            @error('roles')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="mb-4">
            <label for="institution" class="form-label">{{ trans('Asal Institusi') }}</label>
            <input type="text" name="institution" id="institution" value="{{ old('institution', $client->institution) }}" class="form-control @error('institution') is-invalid @enderror" placeholder="{{ trans('Asal Institusi') }}" onkeypress="return hanyaHuruf(event)">
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
                  @isset($client->user->avatar)
                    <img class="img-prev img-profile-center" src="{{ $client->user->getAvatar() }}" alt="">
                  @else
                    <img class="img-prev img-profile-center" src="{{ asset('assets/images/default.png') }}" alt="">
                  @endisset
                </div>
              </div>
            </div>
          </div>

          <input type="hidden" class="form-control" name="fotoLama" value="{{ $client->user->avatar }}">

          <div class="mb-4">
            <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
            <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
            @error('avatar')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="address">{{ trans('Alamat Lengkap') }}</label>
            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" cols="40" rows="4" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address', $client->address) }}</textarea>
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
@endsection