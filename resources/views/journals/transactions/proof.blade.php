@if($proof)
  <a href="{{ Storage::url($proof) }}" target="_blank">
    <i class="fa fa-xs fa-eye me-1"></i>
    {{ trans('Bukti Pembayaran') }}
  </a>
@endif