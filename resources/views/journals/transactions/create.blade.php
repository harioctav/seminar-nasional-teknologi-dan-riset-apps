@extends('layouts.app')
@section('title') {{ trans('page.transactions.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.transactions.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-block-option text-danger">
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
      {{ trans('page.transactions.create') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <div class="mb-4">
      <h4>{{ trans('Tata Cara Pembayaran') }}</h4>
      <ul>
        <li>{{ trans('Pembayaran dilakukan via transfer Bank') }}</li>
        <li>{{ trans('Pemakalah atau Peserta melakukan pembayaran mandiri') }}</li>
        <li>
          {{ trans('Detail Akun Bank :') }}
          <div class="col-md-6 mt-2">
            <ul class="list-group push">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Nomor Rekening') }}
                <span class="fw-semibold">{{ Constant::NO_REK }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Nama Bank') }}
                <span class="fw-semibold">{{ Constant::BANK_NAME }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Nama Pemilik Rekening') }}
                <span class="fw-semibold">{{ Constant::BANK_USER_NAME }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Jumlah Yang Harus Dibayarkan') }}
                <span class="fw-semibold">{{ Helper::formatRupiah(55000) }}</span>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <h6 class="text-center">{{ trans('Mohon untuk melakukan pembayaran sebagai mana mestinya yang harus dibayarkan, jika anda sudah melakukan pembayaran dan mengisi formulir di bawah ini tetapi data belum juga berubah, anda bisa menguhubungi admin agar proses pembayaran bisa diproses dan anda bisa melakukan upload jurnal.') }}</h6>

      <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
        @csrf

        <div class="row justify-content-center">
          <div class="col-md-6">

            <div class="mb-4">
              <label class="form-label" for="amount">{{ trans('Jumlah Bayar') }}</label>
              <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" onkeypress="return hanyaAngka(event)" placeholder="{{ trans('Etc. 45000') }}">
              @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-4">
              <label class="form-label" for="image">{{ trans('Upload Bukti') }}</label>
              <input type="file" accept="image/*" name="proof" id="image" class="form-control @error('proof') is-invalid @enderror">
              @error('proof')
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
</div>
@endsection
@push('javascript')
  <script>
    var rupiahInput = document.getElementById('amount');

    // Mengatur event listener untuk mengupdate format saat pengguna mengetik
    rupiahInput.addEventListener('keyup', function(e) {
      // Mengambil nilai input
      var nominal = this.value;

      // Menghapus karakter non-digit
      nominal = nominal.replace(/\D/g, '');

      // Memformat nilai Rupiah
      var formattedNominal = formatRupiah(nominal);

      // Mengupdate nilai input dengan format Rupiah
      this.value = formattedNominal;
    });

    // Fungsi untuk memformat nilai Rupiah
    function formatRupiah(nominal) {
      var reverse = nominal.toString().split('').reverse().join('');
      var ribuan = reverse.match(/\d{1,3}/g);
      var formattedNominal = ribuan.join(',').split('').reverse().join('');

      return formattedNominal;
    }
  </script>
@endpush