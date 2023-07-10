@can('publishes.update')
  @if($is_active == Constant::ACTIVE)
    <a href="#" onclick="archivePublishes(`{{ route('publishes.update', $uuid) }}`)" class="text-dark">
      <i class="fas fa-archive me-2"></i>
    </a>
  @else
    <a href="#" onclick="archivePublishes(`{{ route('publishes.update', $uuid) }}`)" class="text-success">
      <i class="fas fa-check me-2"></i>
    </a>
  @endif
@endcan
<a href="{{ Storage::url($model->journal->file) }}" target="__blank" class="text-primary">
  <i class="fas fa-download"></i>
</a>