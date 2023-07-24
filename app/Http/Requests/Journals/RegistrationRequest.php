<?php

namespace App\Http\Requests\Journals;

use App\Helpers\Global\Constant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
      'title' => [
        'required', 'string',
        Rule::unique('registrations', 'title')->ignore($this->registration)
      ],
      'start' => 'required|date',
      'end' => 'required|date|after_or_equal:start',
      'type' => 'required|in:' . Constant::UPLOAD . ',' . Constant::SEMINAR . '',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'title.required' => ':attribute tidak boleh dikosongkan',
      'title.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',

      'start.required' => ':attribute tidak boleh dikosongkan',
      'start.date' => ':attribute harus berupa tanggal. Etc: 2023/01/01',
      'start.after_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date',
      'start.before_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date',

      'end.required' => ':attribute tidak boleh dikosongkan',
      'end.date' => ':attribute harus berupa tanggal. Etc: 2023/01/01',
      'end.after_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date',
      'end.before_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date',

      'type.required' => ':attribute tidak boleh dikosongkan',
      'type.in' => ':attribute tidak sesuai pilihan yang disediakan',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function attributes(): array
  {
    return [
      'title' => 'Judul',
      'start' => 'Tanggal Dibuka',
      'end' => 'Tanggal Ditutup',
      'type' => 'Tipe Acara',
    ];
  }
}
