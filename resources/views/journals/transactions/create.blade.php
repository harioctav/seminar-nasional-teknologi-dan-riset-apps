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

    <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
      @csrf

      <div class="mb-4">
        <h4>Kebijakan &amp; Tata Cara Pembayaran</h4>
        <ul>
          <li>{{ trans('Pembayaran dilakukan via transfer Bank') }}</li>
          <li>{{ trans('Pemakalah atau Peserta melakukan pembayaran mandiri') }}</li>
          <li>{{ trans('Pemakalah atau Peserta memilih rekening terlebih dahulu dan detail rekening akan muncul') }}</li>
          <li>Pemakalah atau Peserta melakukan pembayaran pada <strong>rekening yang sudah disediakan</strong></li>
          <li>Pemakalah atau Peserta <strong>yang melakukan pembayaran di luar rekening yang sudah disediakan oleh admin</strong>, maka tidak akan diproses dan kami tidak akan bertanggung jawab pada hal tersebut</li>
          <li>
            <strong>Note:</strong> Jika sudah memilih rekening detail informasi bank tidak muncul, harap melakukan refresh halaman atau gunakan browser yang mendukung
          </li>
          <li>
            Informasi lebih lanjut silahkan hubungi Administrator
          </li>
        </ul>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label for="payment_id" class="form-label">{{ trans('Rekening') }}</label>
            <select name="payment_id" id="payment_id" class="js-select2 form-select @error('payment_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Rekening') }}" style="width: 100%;">
              <option></option>
              @foreach ($payments as $item)
                @if (old('payment_id') == $item->id)
                  <option value="{{ $item->id }}" data-uuid="{{ $item->uuid }}" selected>{{ $item->bank->name }}</option>
                @else
                  <option value="{{ $item->id }}" data-uuid="{{ $item->uuid }}">{{ $item->bank->name }}</option>
                @endif
              @endforeach
            </select>
            @error('payment_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-4" style="display: none" id="bank-detail">

            <div class="mb-4">
              <strong>{{ trans('Detail Informasi Rekening') }}</strong>
              <br>
              <span class="text-muted">{{ trans('Silahkan pilih rekening untuk menampilkan data') }}</span>
            </div>

            <ul class="list-group push">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Nama Bank') }}
                <span class="fw-semibold" id="bank-name"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('No. Rekening') }}
                <span class="fw-semibold" id="bank-number"></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ trans('Atas Nama') }}
                <span class="fw-semibold" id="bank-name-holder"></span>
              </li>
            </ul>

          </div>

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
              {{ trans('Submit Pembayaran') }}
            </button>
          </div>

        </div>
      </div>

    </form>

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

    $(document).ready(function () {
      $('#payment_id').change(function () {
        var selectedOption = $(this).find('option:selected')
        var uuid = selectedOption.attr('data-uuid')

        // Gunakan nilai UUID yang Anda dapatkan
        var url = '{!! route("payments.show", ":uuid") !!}'
        url = url.replace(':uuid', uuid)
        $.getJSON(url, function(response) {
          if (response) {
            $('#bank-detail').show()
            $('#bank-name').text(response.payment.bank.name)
            $('#bank-number').text(response.payment.number)
            $('#bank-name-holder').text(response.payment.holder_name)
          }
        })
      })
    })
  </script>
@endpush