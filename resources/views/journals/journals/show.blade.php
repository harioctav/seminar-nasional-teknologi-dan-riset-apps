{{-- @dd($journal->comments()->paginate(2)) --}}
@extends('layouts.app')
@section('title') {{ trans('page.journals.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.journals.title') }}</h1>
    <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-alt">
        <li class="breadcrumb-item">
          <a href="{{ route('journals.index') }}" class="btn btn-sm btn-block-option text-danger">
            <i class="fa fa-xs fa-chevron-left me-1"></i>
            {{ trans('page.button.back') }}
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.journals.show') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <div class="row justify-content-center">
      <div class="col-6">
        <ul class="list-group push">
          <div class="text-center">
            <li class="list-group-item align-items-center">
              <span>
                {{ trans('Judul Makalah') }}
              </span>
            </li>
            <li class="list-group-item align-items-center">
              <span class="fw-semibold">
                {{ $journal->title }}
              </span>
            </li>
          </div>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Penulis') }}
            <span class="fw-semibold">{{ $journal->user->name }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Tahun Upload') }}
            <span class="fw-semibold">{{ $journal->upload_year }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Original File') }}
            <a href="{{ Storage::url($journal->file) }}" target="_blank">
              <i class="fa fa-xs fa-eye me-1"></i>
              {{ trans('Lihat Makalah') }}
            </a>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Status Revisi') }}
            <span class="fw-semibold">{!! $journal->isStatus() !!}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ trans('Status Publikasi') }}
            <span class="fw-semibold">{!! $journal->isApproved() !!}</span>
          </li>
        </ul>
      </div>
      <div class="col-6">
        @if($journal->selectReviewer)
          <div class="block block-rounded">
            <div class="block-content block-content-full">
              <h6 class="h6 mb-3 text-center">
                {{ trans('Detail Reviewer') }}
              </h6>
              <ul class="nav-items push">
                <li>
                  <div class="d-flex py-3">
                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                      <img class="img-avatar img-avatar48" src="{{ $journal->selectReviewer->user->getAvatar() }}" alt="">
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">{{ $journal->selectReviewer->user->name }}</div>
                      <div class="fs-sm text-muted">{{ $journal->selectReviewer->user->email }}</div>
                    </div>
                  </div>
                </li>
              </ul>
              <ul class="list-group push">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{ trans('Nomor Telepon') }}
                  <span class="fw-semibold">{{ $journal->selectReviewer->user->phone }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{ trans('Tanggal Dipilih') }}
                  <span class="fw-semibold">{{ Helper::customDate($journal->selectReviewer->select_date) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{ trans('Dipilih Oleh') }}
                  <span class="fw-semibold">{{ $journal->selectReviewer->select_by }}</span>
                </li>
              </ul>
            </div>
          </div>
        @else
          <div class="block block-rounded">
            <div class="block-content block-content-full">
              <h6 class="h6 mb-3 text-center">
                {{ trans('Jurnal Belum Memiliki Pereview, Silahkan pilih dahulu atau hubungi Admin') }}
              </h6>
            </div>
          </div>
        @endif
      </div>
    </div>

    @if($journal->selectReviewer)
      <div class="block block-rounded mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title">
            {{ trans('Reviews') }}
          </h3>
        </div>
        <div class="block-content block-content-full">

          @forelse ($journal->comments()->paginate(2) as $comment)
            <div class="pull-x fs-sm mx-2">
              <div class="d-flex push">
                <div class="flex-shrink-0 me-3">
                  <img class="img-avatar img-avatar32" src="{{ $comment->user->getAvatar() }}" alt="">
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold">{{ $comment->user->name }}</span>
                  <mark class="fw-semibold {{ $comment->user->isRoleName() === Constant::REVIEWER ? 'text-danger' : 'text-success' }}">{{ $comment->user->isRoleName() }}</mark>
                  <p class="my-1">
                    <p class="my-1">{!! $comment->comment !!}</p>
                  </p>
                  @if($comment->file_revision)
                    <a class="me-1" target="__blank" href="{{ Storage::url($comment->file_revision) }}">{{ trans('Dokumen') }}</a>
                  @endif
                  @if($comment->user_id == me()->id)
                    <a class="me-1" href="#" onclick="deleteComment(`{{ route('comments.destroy', $comment->uuid) }}`)" class="text-danger me-2">{{ trans('Hapus') }}</a>
                  @endif
                  <span class="text-muted"><em>Komentar diupload pada </em></span>
                  <span class="text-muted fw-semibold">{{ $comment->created_at->format('Y-m-d H:i') }}</span>
                  <span class="text-muted"><em>({{ $comment->created_at->diffForHumans() }})</em></span>
                </div>
              </div>
            </div>
          @empty
            <p class="mb-5 text-center">
              <em>{{ trans('Belum Ada Komentar atau Review') }}</em>
            </p>
          @endforelse

          <div class="text-center">
            {{ $journal->comments()->paginate(2)->links('pagination::bootstrap-5') }}
          </div>

          <div class="mb-2">
            <span class="fw-semibold">
              {{ trans('NOTED (Pemakalah): ') }} <em>{{ trans('Jika jurnal anda siap untuk dipublikasi, mohon untuk kembali ke halaman makalah kemudian anda lakukan update pada file makalah anda') }}</em>
            </span>
          </div>

          @if (isRoleName() !== Constant::ADMIN)
            @if($journal->status !== Constant::READY_PUBLISH)
              
              @if(isRoleName() === Constant::REVIEWER)
                @if($journal->selectReviewer->user->id == me()->id)
                  <form action="{{ route('comments.store') }}" method="POST" onsubmit="return disableSubmitButton()" enctype="multipart/form-data">
                    @csrf
        
                    <input type="hidden" name="journal_id" value="{{ $journal->id }}" readonly>
                    <input type="hidden" name="journal_uuid" value="{{ $journal->uuid }}" readonly>
                    <input type="hidden" name="user_id" value="{{ me()->id }}" readonly>

                    <div class="mb-4">
                      <label class="form-label">{{ trans('Pilih Status Revisi') }}</label>
                      <div class="space-x-2">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="status-draft" name="status" value="{{ Constant::DRAFT }}" {{ $journal->status === Constant::DRAFT ? 'checked' : '' }}>
                          <label class="form-check-label text-primary" for="status-draft">{{ Constant::DRAFT }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="status-in-revision" name="status" value="{{ Constant::IN_REVISION }}" {{ $journal->status === Constant::IN_REVISION ? 'checked' : '' }}>
                          <label class="form-check-label text-warning" for="status-in-revision">{{ Constant::IN_REVISION }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" id="status-ready-publish" name="status" value="{{ Constant::READY_PUBLISH }}" {{ $journal->status === Constant::READY_PUBLISH ? 'checked' : '' }}>
                          <label class="form-check-label text-success" for="status-ready-publish">{{ Constant::READY_PUBLISH }}</label>
                        </div>
                      </div>
                      <small class="text-muted">{{ trans('Jika ada perubahan pada status revisi di jurnal, anda bisa memilih pilihan di atas') }}</small>
                    </div>
        
                    <div class="row">
                      <div class="col-6">
                        <div class="mb-3">
                          <label for="file_revision" class="form-label">{{ __('Upload File Revisi') }} <em>(Opsional)</em></label>
                          <input type="file" accept="application/pdf" name="file_revision" id="file_revision" class="form-control @error('file') is-invalid @enderror">
                          <small class="text-muted">{{ trans('Hanya boleh memasukkan file dengan format .pdf') }}</small>
                          @error('file_revision')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
        
                    <div class="mb-3">
                      <label for="js-ckeditor" class="form-label">{{ trans('Komentar Anda') }} <em>(Untuk Revisi)</em></label>
                      <textarea id="js-ckeditor" name="comment">{{ old('comment') }}</textarea>
                      @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
        
                    <div class="row">
                      <div class="col-6">
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary w-100" id="submit-button">
                            <i class="fa fa-fw fa-paper-plane opacity-50 me-1"></i>
                            {{ trans('Kirim Komentar') }}
                          </button>
                        </div>
                      </div>
                    </div>
        
                  </form>
                @endif
              @endif

              @if(isRoleName() === Constant::PEMAKALAH)
                @if($journal->user_id == me()->id)
                  <form action="{{ route('comments.store') }}" method="POST" onsubmit="return disableSubmitButton()" enctype="multipart/form-data">
                    @csrf
        
                    <input type="hidden" name="journal_id" value="{{ $journal->id }}" readonly>
                    <input type="hidden" name="journal_uuid" value="{{ $journal->uuid }}" readonly>
                    <input type="hidden" name="user_id" value="{{ me()->id }}" readonly>
        
                    <div class="row">
                      <div class="col-6">
                        <div class="mb-3">
                          <label for="file_revision" class="form-label">{{ __('Upload File Revisi') }} <em>(Opsional)</em></label>
                          <input type="file" accept="application/pdf" name="file_revision" id="file_revision" class="form-control @error('file') is-invalid @enderror">
                          <small class="text-muted">{{ trans('Hanya boleh memasukkan file dengan format .pdf') }}</small>
                          @error('file_revision')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
        
                    <div class="mb-3">
                      <label for="js-ckeditor" class="form-label">{{ trans('Komentar Anda') }} <em>(Untuk Revisi)</em></label>
                      <textarea id="js-ckeditor" name="comment">{{ old('comment') }}</textarea>
                      @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
        
                    <div class="row">
                      <div class="col-6">
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary w-100" id="submit-button">
                            <i class="fa fa-fw fa-paper-plane opacity-50 me-1"></i>
                            {{ trans('Kirim Komentar') }}
                          </button>
                        </div>
                      </div>
                    </div>
        
                  </form>
                @endif
              @endif

            @endif
          @endif

        </div>
      </div>
    @endif

  </div>
</div>
@endsection
@push('javascript')
  <script>
    function deleteComment(url) {
      Swal.fire({
        icon: 'warning',
        title: 'Apakah Anda Yakin?',
        html: 'Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!',
        showCancelButton: true,
        confirmButtonText: 'Hapus Data',
        cancelButtonText: 'Batalkan',
        cancelButtonColor: '#E74C3C',
        confirmButtonColor: '#3498DB'
      }).then((result) => {
        if (result.value) {
          $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete'
          })
          .done((response) => {
            Swal.fire({
              icon: 'success',
              title: response.message,
              confirmButtonText: 'Selesai'
            })
            location.reload()
          })
          .fail((errors) => {
            Swal.fire({
              icon: 'error',
              title: errors.responseJSON.message,
              confirmButtonText: 'Mengerti'
            })
            return
          })
        } else if (result.dismiss == swal.DismissReason.cancel) {
          Swal.fire({
            icon: 'error',
            title: 'Tidak ada perubahan disimpan',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#3498DB'
          })
        }
      })
    }
  </script>
@endpush