  <!-- Notifications Dropdown -->
  <div class="dropdown dropdown-notifications d-inline-block me-2">
    <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-fw fa-bell me-1"></i>
      <small class="text-white notifications-count"></small>
    </button>
    <div class="dropdown-menu dropdown-menu-lg p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown">
      <div class="p-2 bg-body-light border-bottom text-center rounded-top">
        <h5 class="dropdown-header text-uppercase">{{ trans('Notifikasi') }}</h5>
      </div>
      <ul class="nav-items mb-2" id="notifications-list">
        
      </ul>
      <div id="pagination" class="mt-3"></div>
    </div>
  </div>
  <!-- END Notifications Dropdown -->