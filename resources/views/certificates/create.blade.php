@extends('layouts.app')
@section('title') {{ trans('page.certificates.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.certificates.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('certificates.index') }}" class="btn btn-sm btn-block-option text-danger">
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
        {{ trans('page.certificates.create') }}
      </h3>
    </div>
    <div class="block-content">

      <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
        @csrf

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label for="user_id" class="form-label">{{ trans('Pengguna') }}</label>
              <select name="user_id" id="user_id" class="js-select2 form-select @error('user_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Pengguna') }}" style="width: 100%;">
                <option></option>
                @foreach ($users as $item)
                  @if (old('user_id') == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                  @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endif
                @endforeach
              </select>
              @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label for="registration_id" class="form-label">{{ trans('Kegiatan') }}</label>
              <select name="registration_id" id="registration_id" class="js-select2 form-select @error('registration_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Kegiatan') }}" style="width: 100%;">
                <option></option>
                @foreach ($schedules as $item)
                  @if (old('registration_id') == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->type . ' at ' . Helper::customDate($item->end) }}</option>
                  @else
                    <option value="{{ $item->id }}">{{ $item->type . ' at ' . Helper::customDate($item->end) }}</option>
                  @endif
                @endforeach
              </select>
              @error('registration_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <button type="submit" class="btn btn-primary w-100" id="submit-button">
                <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
                {{ trans('Generate Sertifikat') }}
              </button>
            </div>

          </div>
        </div>
      
      </form>

    </div>
  </div>
@endsection