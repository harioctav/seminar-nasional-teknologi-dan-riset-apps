@if ($status === Constant::PENDING)
  <span class="badge text-secondary">{{ Constant::PENDING }}</span>
@elseif ($status === Constant::APPROVED)
  <span class="badge text-success">{{ Constant::APPROVED }}</span>
@else
  <span class="badge text-danger">{{ Constant::REJECTED }}</span>
@endif