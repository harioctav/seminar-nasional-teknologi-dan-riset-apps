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
      {{ trans('page.journals.show') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <div class="row justify-content-center">
      <div class="col-6">
        <ul class="list-group push">
          <div class="text-center">
            <li class="list-group-item align-items-center">
              <span>
                {{ trans('Judul Makalah') }}
              </span>
            </li>
            <li class="list-group-item align-items-center">
              <span class="fw-semibold">
                {{ $journal->title }}
              </span>
            </li>
          </div>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Penulis') }}
            <span class="fw-semibold">{{ $journal->user->name }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Tahun Upload') }}
            <span class="fw-semibold">{{ $journal->upload_year }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('File') }}
            <a href="{{ Storage::url($journal->file) }}" target="_blank">
              <i class="fa fa-xs fa-eye me-1"></i>
              {{ trans('Lihat Makalah') }}
            </a>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Status') }}
            <span class="fw-semibold">{!! $journal->isApproved() !!}</span>
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>
@endsection