<?php

namespace App\Http\Requests\Submissions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CertificateRequest extends FormRequest
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
      'registration_id' => [
        'required',
      ],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'user_id.required' => ':attribute tidak boleh dikosongkan',
      'user_id.unique' => 'Anda sudah mencetak sertifikat pada seminar ini. Tidak bisa duplikat.',
      'registration_id.required' => ':attribute tidak boleh dikosongkan',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'user_id' => 'Pengguna',
      'registration_id' => 'Agenda',
    ];
  }
}
