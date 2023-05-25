@canany(['users.edit', 'clients.edit'])
<a href="{{ route('users.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  {{-- @if ($model->hasRole(Constant::OFFICER))
  @else
    <a href="{{ route('clients.edit', $model->client->uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @endif --}}
@endcan
@can('users.destroy')
  <a href="#" onclick="deleteUser(`{{ route('users.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan