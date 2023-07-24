@extends('layouts.app')
@section('title') {{ trans('page.certificates.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.certificates.title') }}</h1>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.certificates.index') }}
      </h3>
      <div class="block-options">
        @if(isRoleName() === Constant::PEMAKALAH || isRoleName() === Constant::PARTICIPANT)
          @can('certificates.create')
            <a href="{{ route('certificates.create') }}" class="btn btn-sm btn-primary">
              <i class="fa fa-plus fa-xs me-1"></i>
              {{ trans('page.certificates.create') }}
            </a>
          @endcan
        @endif
      </div>
    </div>
    <div class="block-content">

      <div class="my-3">
        {{ $dataTable->table() }}
      </div>

    </div>
  </div>
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}
@endpush