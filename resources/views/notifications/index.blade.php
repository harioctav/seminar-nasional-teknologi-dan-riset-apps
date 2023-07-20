@extends('layouts.app')
@section('title') {{ trans('page.notifications.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.notifications.title') }}</h1>
  </div>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.notifications.index') }}
      </h3>
    </div>
    <div class="block-content">



    </div>
  </div>
@endsection
@push('javascript')
  <script>

  </script>
@endpush