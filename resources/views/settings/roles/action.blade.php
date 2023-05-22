@if($name === Constant::ADMIN)
  <span class="badge text-danger">{{ trans('Tidak Bisa Diubah') }}</span>
@else
  @can('roles.edit')
    <a href="{{ route('roles.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @endcan
  @can('roles.destroy')
    <a href="#" onclick="deleteRole(`{{ route('roles.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
  @endcan
@endif