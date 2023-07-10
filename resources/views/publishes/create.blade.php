@extends('layouts.app')
@section('title') {{ trans('page.publishes.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.publishes.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('publishes.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.publishes.create') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('publishes.store') }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="journal_id" class="form-label">{{ trans('Journal') }}</label>
            <select name="journal_id" id="journal_id" class="js-select2 form-select @error('journal_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Journal') }}" style="width: 100%;">
              <option></option>
              @foreach ($journals as $item)
                @if (old('journal_id') == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->title . ' - ' . $item->user->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->title . ' - ' . $item->user->name }}</option>
                @endif
              @endforeach
            </select>
            @error('journal_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="publish_date" class="form-label">{{ trans('Tanggal Publish') }}</label>
            <input type="text" name="publish_date" id="publish_date" class="form-control @error('publish_date') is-invalid @enderror" value="{{ date('Y-m-d') }}" readonly>
            @error('publish_date')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

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