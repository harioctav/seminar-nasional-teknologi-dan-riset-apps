<div class="modal fade" id="modal-block-popin" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="block block-rounded block-transparent mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title">{{ trans('Pilih Type Pengguna') }}</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-fw fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content fs-sm">
          <p class="text-center fw-semibold">{{ trans('Silahkan pilih tipe pengguna yang ingin anda tambahkan') }}</p>
          <div class="text-center mb-4">
            <a href="{{ route('users.create') }}" class="btn btn-info btn-hero me-1 mb-3">
              <i class="fa fa-fw fa-users me-1"></i>
              {{ Constant::REVIEWER }}
            </a>
            <a href="#" class="btn btn-success btn-hero me-1 mb-3">
              <i class="fas fa-fw fa-clipboard-user me-1"></i>
              {{ Constant::PEMAKALAH }}
            </a>
            <a href="#" class="btn btn-warning btn-hero me-1 mb-3">
              <i class="fas fa-fw fa-clipboard-user me-1"></i>
              {{ Constant::PARTICIPANT }}
            </a>
          </div>
        </div>
        <div class="block-content block-content-full text-end bg-body">
          <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>