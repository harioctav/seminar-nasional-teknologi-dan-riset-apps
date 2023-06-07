@can('transactions.show')
  <a href="{{ route('transactions.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('transactions.destroy')
  @if($status === Constant::PENDING)
    <a href="#" onclick="deleteTransaction(`{{ route('transactions.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endif
@endcan