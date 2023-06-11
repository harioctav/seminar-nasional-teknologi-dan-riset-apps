<?php

namespace App\Http\Requests\Settings;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
      'bank_id' => 'required',
      'number' => [
        'required',
        'numeric',
        Rule::unique('payments', 'number')->ignore($this->payment),
      ],
      'holder_name' => 'required|string|max:100',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'bank_id.required' => ':attribute tidak boleh dikosongkan',

      'holder_name.required' => ':attribute tidak boleh dikosongkan',
      'holder_name.string' => ':attribute tidak valid, masukkan yang benar',
      'holder_name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'number.required' => ':attribute tidak boleh dikosongkan',
      'number.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'number.numeric' => ':attribute harus berupa angka',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'bank_id' => 'Bank',
      'number' => 'Nomor rekening',
      'holder_name' => 'Nama pemegang rekening',
    ];
  }
}
