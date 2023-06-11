@can('payments.edit')
  <a href="{{ route('payments.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('payments.destroy')
  <a href="#" onclick="deletePayment(`{{ route('payments.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan