{{-- @if ($status === Constant::DRAFT)
  @can('journals.edit')
    <a href="{{ route('journals.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @endcan
@endif --}}
@can('journals.show')
  <a href="{{ route('journals.show', $uuid) }}" class="text-primary me-2"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@if(isRoleName() === Constant::ADMIN)
  @if ($status === Constant::DRAFT)
    @can('journals.destroy')
      <a href="#" onclick="deleteJournal(`{{ route('journals.destroy', $uuid) }}`)" class="text-danger me-2"><i class="fa fa-sm fa-trash"></i></a>
    @endcan
  @endif
@endif