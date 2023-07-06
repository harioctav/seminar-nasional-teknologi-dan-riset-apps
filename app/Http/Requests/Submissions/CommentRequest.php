<?php

namespace App\Http\Requests\Submissions;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      'user_id' => 'required',
      'journal_id' => 'required',
      'file_revision' => 'nullable|mimes:pdf|max:10000',
      'comment' => 'required|string',
    ];
  }
}
