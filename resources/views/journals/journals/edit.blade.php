@extends('layouts.app')
@section('title') {{ trans('page.journals.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.journals.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('journals.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.journals.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('journals.update', $journal->uuid) }}" method="POST" onsubmit="return disableSubmitButton()" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $journal->title) }}" placeholder="Judul/Topik Makalah">
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="abstract" class="form-label">Abstrak</label>
            <textarea name="abstract" class="editor form-control @error('abstract') is-invalid @enderror" id="abstract" cols="30" rows="5">{{ old('abstract', $journal->abstract) }}</textarea>
            @error('abstract')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="upload_year" class="form-label">Tahun Upload</label>
            <input type="text" name="upload_year" id="upload_year" class="form-control @error('upload_year') is-invalid @enderror" value="{{ date('Y') }}" readonly>
            @error('upload_year')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <input type="hidden" name="oldFile" value="{{ $journal->file }}">

          <div class="mb-4">
            <label for="file" class="form-label">{{ __('Upload File Makalah') }}</label>
            <input type="file" accept="application/pdf" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
            <small class="text-muted">{{ trans('Hanya boleh memasukkan file dengan format .pdf') }}</small>
            @error('file')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <button type="submit" class="btn btn-primary w-100" id="submit-button">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('page.button.edit') }}
            </button>
          </div>

        </div>
      </div>

    </form>

  </div>
</div>
@endsection