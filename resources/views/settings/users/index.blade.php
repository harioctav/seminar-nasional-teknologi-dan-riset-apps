@extends('layouts.app')
@section('title') {{ trans('page.users.title') }} @endsection
@section('hero')
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">{{ trans('page.users.title') }}</h1>
    </div>
  </div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.users.index') }}
      </h3>
      <div class="block-options">
        @canany(['users.create', 'clients.create'])
          <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-block-popin">
            <i class="fa fa-plus fa-xs me-1"></i>
            {{ trans('page.users.create') }}
          </button>
        @endcan
      </div>
    </div>
    <div class="block-content">

      <div class="row">
        <div class="col-md-4">
          <div class="mb-4">
            <label for="status" class="form-label">{{ trans('Filter Status') }}</label>
            <select type="text" class="form-select" name="status" id="status">
              <option value="{{ Constant::ALL }}">{{ Constant::ALL }}</option>
              <option value="{{ Constant::ACTIVE }}">{{ trans('Aktif') }}</option>
              <option value="{{ Constant::INACTIVE }}">{{ trans('Tidak Aktif') }}</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="mb-1">
            <label for="roles" class="form-label">{{ trans('Filter Peran') }}</label>
            <select type="text" class="form-select" name="roles" id="roles">
              <option value="{{ Constant::ALL }}">{{ Constant::ALL }}</option>
              <option value="{{ Constant::REVIEWER }}">{{ Constant::REVIEWER }}</option>
              <option value="{{ Constant::PEMAKALAH }}">{{ Constant::PEMAKALAH }}</option>
              <option value="{{ Constant::PARTICIPANT }}">{{ Constant::PARTICIPANT }}</option>
            </select>
          </div>
        </div>
      </div>

      <div class="my-3">
        {{ $dataTable->table() }}
      </div>

    </div>
  </div>

  @includeIf('modals.users-create')
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}

  <script>
    let table

    $(function () {
      table = $('.table').DataTable()

      $('#status').on('change', function (e) {
        table.draw()
        e.preventDefault()
      })

      $('#roles').on('change', function (e) {
        table.draw()
        e.preventDefault()
      })
    })

    function deleteUser(url) {
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
            table.ajax.reload()
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

    function statusUser(url) {
      Swal.fire({
        icon: 'warning',
        title: 'Apakah Anda Yakin?',
        html: 'Dengan menekan tombol <b>Ubah Status</b>, Maka <b>Status</b> akan berubah!',
        showCancelButton: true,
        confirmButtonText: 'Ubah Status',
        cancelButtonText: 'Batalkan',
        cancelButtonColor: '#E74C3C',
        confirmButtonColor: '#3498DB'
      }).then((result) => {
        if (result.value) {
          $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'patch'
          })
          .done((response) => {
            Swal.fire({
              icon: 'success',
              title: response.message,
              confirmButtonText: 'Selesai'
            })
            table.ajax.reload()
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