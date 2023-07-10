<?php

namespace App\Http\Requests\Submissions;

use Illuminate\Foundation\Http\FormRequest;

class PublishRequest extends FormRequest
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
      'journal_id' => 'required',
      'publish_date' => 'required|date',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'journal_id.required' => ':attribute tidak boleh dikosongkan',
      'publish_date.required' => ':attribute tidak boleh dikosongkan',
      'publish_date.date' => ':attribute tidak valid, masukkan format tanggal yang benar',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'journal_id' => 'Makalah',
      'publish_date' => 'Tanggal publikasi',
    ];
  }
}
