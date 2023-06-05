@extends('layouts.app')
@section('title') {{ trans('page.registrations.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.registrations.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('registrations.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.registrations.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('registrations.update', $registration->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label class="form-label" for="title">{{ trans('Agenda Acara') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title', $registration->title) }}" class="form-control @error('title') is-invalid @enderror" onkeypress="return hanyaHuruf(event)">
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="start">{{ trans('Tanggal Mulai') }}</label>
            <input type="date" name="start" id="start" value="{{ old('start', date('Y-m-d', strtotime($registration->start->toDateString()))) }}" class="form-control @error('start') is-invalid @enderror">
            @error('start')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="end">{{ trans('Tanggal Selesai') }}</label>
            <input type="date" name="end" id="end" value="{{ old('end', date('Y-m-d', strtotime($registration->end->toDateString()))) }}" class="form-control @error('end') is-invalid @enderror">
            @error('end')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="status">{{ trans('Status') }}</label>
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
              <option selected="selected" disabled>{{ trans('Pilih Status') }}</option>
              <option value="{{ Constant::OPEN }}" {{ old('status', $registration->status) === Constant::OPEN ? 'selected' : '' }}>{{ Constant::OPEN }}</option>
              <option value="{{ Constant::CLOSE }}" {{ old('status', $registration->status) === Constant::CLOSE ? 'selected' : '' }}>{{ Constant::CLOSE }}</option>
            </select>
            @error('status')
              <div class="invalid-feedback"><b>{{ $message }}</b></div>
            @enderror
          </div>

        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6">
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