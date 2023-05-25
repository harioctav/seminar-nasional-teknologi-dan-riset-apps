@if($status == Constant::ACTIVE)
  <a href="#" onclick="statusUser(`{{ route('users.status', $uuid) }}`)" class="text-dark me-2"><i class="fa fa-sm fa-ban me-2"></i>{{ trans('Non-aktifkan') }}</a>
@else
  <a href="#" onclick="statusUser(`{{ route('users.status', $uuid) }}`)" class="text-success me-2"><i class="fa fa-sm fa-check-circle me-2"></i>{{ trans('Aktifkan') }}</a>
@endif