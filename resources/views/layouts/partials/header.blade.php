<div class="content-header">
  <!-- Left Section -->
  <div class="d-flex align-items-center">
    <!-- Logo -->
    <a class="fw-semibold fs-5 tracking-wider text-dual me-3" href="{{ route('home') }}">
      {{ trans('Semnastera Politeknik Sukabumi') }}
    </a>
    <!-- END Logo -->
  </div>
  <!-- END Left Section -->

  <!-- Right Section -->
  <div class="d-flex align-items-center">
    <!-- Open Search Section (visible on smaller screens) -->

    <!-- User Dropdown -->
    <div class="dropdown d-inline-block ms-2">
      <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="rounded-circle" src="{{ me()->getAvatar() }}" alt="Header Avatar" style="width: 21px;" />
        <span class="d-none d-sm-inline-block ms-2">{{ me()->name }}</span>
        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
        <div class="p-3 text-center bg-body-light border-bottom rounded-top">
          <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ me()->getAvatar() }}" alt="">
          <p class="mt-2 mb-0 fw-medium">{{ me()->name }}</p>
          <p class="mb-0 text-muted fs-sm fw-medium">{{ isRoleName() }}</p>
        </div>
        <div class="p-2">
          <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
            <span class="fs-sm fw-medium">{{ trans('Profile') }}</span>
          </a>
          <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('users.password', me()->uuid) }}">
            <span class="fs-sm fw-medium">{{ trans('Ubah Kata Sandi') }}</span>
          </a>
        </div>
        <div role="separator" class="dropdown-divider m-0"></div>
        <div class="p-2">
          <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="fs-sm fw-medium">{{ trans('Keluar Aplikasi') }}</span>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
    </div>
    <!-- END User Dropdown -->
  </div>
  <!-- END Right Section -->
</div>