<button type="button" class="btn btn-alt-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-select-reviewer">{{ trans('Pilih Reviewer') }}</button>

<div class="modal fade" id="modal-select-reviewer" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin" role="document">
    <div class="modal-content">
      <form action="{{ route('select-reviewers.store') }}" method="POST" onsubmit="return disableSubmitButton()">
        @csrf

        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">{{ trans('Pilih Reviewer Untuk Journal Ini') }}</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">

            <input type="hidden" name="journal_id" value="{{ $row->id }}">

            <div class="mb-4">
              <label for="user_id" class="form-label">{{ trans('Reviewer') }}</label>
              <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                <option value="" selected>{{ trans('Pilih Reviewer') }}</option>
                @foreach ($users as $item)
                  @if (old('user_id') == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                  @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endif
                @endforeach
              </select>
              @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

          </div>
          <div class="block-content block-content-full text-end bg-body">
            <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal" id="submit-button">{{ trans('page.button.create') }}</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>