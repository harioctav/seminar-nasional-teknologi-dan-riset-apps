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
      'payment_id' => 'required',
      'registration_id' => 'required',
      'proof' => 'required|image|mimes:jpg,png|max:3048',
      'amount' => 'required',
    ];
  }

  public function messages(): array
  {
    return [
      'payment_id.required' => ':attribute tidak boleh dikosongkan',
      'registration_id.required' => ':attribute tidak boleh dikosongkan',
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
      'payment_id' => 'Rekening pembayaran',
      'registration_id' => 'Jadwal Kegiatan',
      'amount' => 'Jumlah Bayar',
      'proof' => 'Bukti Bayar',
    ];
  }
}
