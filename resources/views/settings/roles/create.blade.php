@extends('layouts.app')
@section('title') {{ trans('page.roles.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.roles.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('roles.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.roles.create') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('roles.store') }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label class="form-label" for="name">{{ trans('Nama Peran') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" onkeypress="return hanyaHuruf(event)">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>
      </div>

      <div class="mb-4">
        <div class="space-y-2">
          <div class="form-check">
            <input type="checkbox" name="all_permission" id="all_permission" class="form-check-input @error('permission') is-invalid @enderror">
            <label for="all_permission" class="form-check-label">{{ trans('Pilih Semua Hak Akses') }}</label>
            @error('permission')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="row">
        @foreach ($permissions as $data)
          <div class="col-md-4">
            <div class="card push">
              <div class="card-header border-bottom-0">
                <h6 class="block-title">{{ trans('permission.' . $data->name) }}</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    @foreach ($data->permissions as $item)
                      <div class="space-y-2">
                        <div class="form-check">
                          <input class="permission form-check-input @error('permission') is-invalid @enderror" name="permission[{{ $item->name }}]" id="permission-{{ $item->name }}" type="checkbox" value="{{ $item->name }}">
                          <label class="form-check-label" for="permission-{{ $item->name }}">{{ trans('permission.' . $item->name) }}</label>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="mb-4">
            <button type="submit" class="btn btn-primary w-100" id="submit-button">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('page.button.create') }}
            </button>
          </div>
        </div>
      </div>

    </form>

  </div>
</div>
@endsection
@push('javascript')
<script>
  @vite('resources/js/settings/roles/index.js')
</script>
@endpush