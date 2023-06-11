@extends('layouts.app')
@section('title') {{ trans('page.payments.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.payments.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('payments.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.payments.edit') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('payments.update', $payment->uuid) }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf
      @method('PATCH')

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="bank_id" class="form-label">{{ trans('Bank') }}</label>
            <select name="bank_id" id="bank_id" class="js-select2 form-select @error('bank_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Bank') }}" style="width: 100%;">
              <option></option>
              @foreach ($banks as $item)
                @if (old('bank_id', $payment->bank_id) == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
            @error('bank_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label class="form-label" for="number">{{ trans('Nomor Rekening') }}</label>
            <input type="text" name="number" id="number" value="{{ old('number', $payment->number) }}" class="form-control @error('number') is-invalid @enderror" onkeypress="return hanyaAngka(event)">
            @error('number')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4">
            <label for="holder_name" class="form-label">{{ trans('Nama Pemegang Rekening') }}</label>
            <input type="text" name="holder_name" id="holder_name" class="form-control @error('holder_name') is-invalid @enderror" value="{{ old('holder_name', $payment->holder_name) }}" onkeypress="return hanyaHuruf(event)">
            @error('holder_name')
              <div class="invalid-feedback">{{ $message }}</div>
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