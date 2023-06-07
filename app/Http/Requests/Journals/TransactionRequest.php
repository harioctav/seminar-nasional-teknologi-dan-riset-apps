<?php

namespace App\Http\Requests\Journals;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
      'amount' => 'required',
      'proof' => 'required|image|mimes:jpg,png|max:3048',
    ];
  }

  public function messages(): array
  {
    return [
      'amount.required' => ':attribute tidak boleh dikosongkan',

      'proof.required' => ':attribute tidak boleh dikosongkan',
      'proof.image' => ':attribute tidak valid, pastikan memilih gambar',
      'proof.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'proof.max' => ':attribute terlalu besar, maksimal :max kb',
    ];
  }

  public function attributes(): array
  {
    return [
      'amount' => 'Jumlah Bayar',
      'proof' => 'Bukti Bayar',
    ];
  }
}
