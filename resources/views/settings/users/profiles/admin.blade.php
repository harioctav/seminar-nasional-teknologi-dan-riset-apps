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

      <form action="{{ route('users.update', $user->uuid) }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
        @csrf
        @method('PATCH')

        <h2 class="content-heading pt-0">
          <i class="fa fa-fw fa-user-circle text-muted me-1"></i>
          {{ trans('Ubah Profile') }}
        </h2>

        <div class="row push">
          <div class="col-lg-4">
            <p class="text-muted">
              {{ trans('Info penting akun Anda. Nama pengguna Anda akan terlihat oleh publik.') }}
            </p>
          </div>
          <div class="col-lg-8 col-xl-5">

            <input type="hidden" name="roles" id="roles" value="{{ old('roles', $user->isRoleName()) }}" class="form-control">

            <div class="mb-4">
              <label for="name" class="form-label">{{ trans('Nama') }}</label>
              <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Input Nama') }}" onkeypress="return hanyaHuruf(event)">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="email" class="form-label">{{ trans('Email') }}</label>
              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required placeholder="Input Email" readonly>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
              <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" onkeypress="return hanyaAngka(event)" placeholder="Input No. Handphone">
              @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <label class="form-label">{{ trans('page.image') }}</label>
                  <div class="block-options">
                    <a href="#" onclick="deleteImage(`{{ route('users.image', $user->uuid) }}`)" class="text-danger"><i class="fas fa-trash"></i></a>
                  </div>
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

            <div class="mb-4">
              <input type="hidden" name="old_avatar" id="old_avatar" class="form-control" value="{{ $user->avatar }}">
            </div>

            <div class="mb-4">
              <label class="form-label" for="image">{{ trans('Upload New Avatar') }}</label>
              <input class="form-control @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="avatar" onchange="return previewImage()">
              @error('avatar')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

          </div>
        </div>

        <div class="row push">
          <div class="col-lg-8 col-xl-5 offset-lg-4">
            <div class="mb-4">
              <button type="submit" class="btn btn-primary w-100" id="submit-button">
                <i class="fa fa-check-circle opacity-50 me-1"></i>
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
@push('javascript')
  <script>
    function deleteImage(url) {
      Swal.fire({
        icon: 'warning',
        title: 'Apakah Anda Yakin?',
        html: 'Dengan menekan tombol hapus, Maka <b>Foto Profil</b> akan hilang!',
        showCancelButton: true,
        confirmButtonText: 'Hapus Data',
        cancelButtonText: 'Batalkan',
        cancelButtonColor: '#E74C3C',
        confirmButtonColor: '#3498DB'
      }).then((result) => {
        if (result.value) {
          $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'post'
          }).done((response) => {
            Swal.fire({
              icon: 'success',
              title: response.message,
              confirmButtonText: 'Selesai'
            })

            // Reload halaman setelah di klik
            setInterval(function() {
              location.reload();
            }, 1000);

          }).fail((error) => {
            Swal.fire({
              icon: 'error',
              title: errors.responseJSON.message,
              confirmButtonText: 'Mengerti'
            })
            return
          })
        } else if (result.dismiss == swal.DismissReason.cancel) {
          Swal.fire({
            icon: 'error',
            title: 'Tidak ada perubahan disimpan',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#3498DB'
          })
        }
      })
    }
  </script>
@endpush