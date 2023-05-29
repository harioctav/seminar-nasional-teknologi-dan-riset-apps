@canany(['users.edit', 'clients.edit'])
  @if ($model->hasRole(Constant::PEMAKALAH) || $model->hasRole(Constant::PARTICIPANT))
    <a href="{{ route('clients.edit', $model->client->uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @else
    <a href="{{ route('users.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @endif
@endcan
@can('users.destroy')
  <a href="#" onclick="deleteUser(`{{ route('users.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
@endcan