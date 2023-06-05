@can('registrations.edit')
<a href="{{ route('registrations.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('registrations.destroy')
<a href="#" onclick="deleteRegistration(`{{ route('registrations.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan