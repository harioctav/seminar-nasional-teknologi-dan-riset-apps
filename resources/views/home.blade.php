@extends('layouts.app')
@section('title') {{ trans('page.overview.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="py-3 text-center">
    <h1 class="h3 fw-bold mb-2">
      Dashboard
    </h1>
    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
      Welcome to your app, everything looks great!
    </h2>
  </div>
</div>
@endsection
@section('content')
{{-- <div class="mb-4">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          {{ __('You are logged in!') }}
        </div>
      </div>
    </div>
  </div>
</div> --}}

<!-- Stats -->
<div class="row justify-content-center">
  <div class="col-6 col-md-3 col-lg-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
      <div class="block-content block-content-full">
        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Reviewer Aktif') }}</div>
        <div class="fs-2 fw-normal text-dark">{{ $reviewerActive . ' Reviewer' }}</div>
      </div>
    </a>
  </div>
  <div class="col-6 col-md-3 col-lg-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
      <div class="block-content block-content-full">
        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Makalah Terpublikasi') }}</div>
        <div class="fs-2 fw-normal text-dark">{{ $publishesJournal . ' Makalah' }}</div>
      </div>
    </a>
  </div>
  <div class="col-6 col-md-3 col-lg-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
      <div class="block-content block-content-full">
        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ trans('Pengguna Terdaftar') }}</div>
        <div class="fs-2 fw-normal text-dark">{{ $totalUser . ' Pengguna' }}</div>
      </div>
    </a>
  </div>
  <div class="col-6 col-md-3 col-lg-6 col-xl-3">
    <a class="block block-rounded block-link-pop" href="javascript:void(0)">
      <div class="block-content block-content-full">
        <div class="fs-sm fw-semibold text-uppercase text-muted">Sertifikat Digenerate</div>
        <div class="fs-2 fw-normal text-dark">{{ $totalGenerate . ' Sertifikat' }}</div>
      </div>
    </a>
  </div>
</div>
<!-- END Stats -->

@endsection
