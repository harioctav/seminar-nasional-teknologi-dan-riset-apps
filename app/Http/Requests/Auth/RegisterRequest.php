<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use App\Helpers\Global\Constant;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
      'first_title' => 'nullable|string|max:5',
      'first_name' => 'required|string|max:20',
      'last_name' => 'required|string|max:20',
      'last_title' => 'nullable|string|max:5',
      'gender' => 'required|in:' . Constant::MALE . ',' . Constant::FEMALE . '',
      'roles' => 'required',
      'address' => 'required|string',
      'institution' => 'required|string',
      'password' => 'required|string|min:8|confirmed',
      'email' => [
        'required', 'email',
        Rule::unique('users', 'email'),
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        Rule::unique('users', 'phone'),
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
      'first_title.string' => ':attribute tidak valid, masukkan yang benar',
      'first_title.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'first_name.required' => ':attribute tidak boleh dikosongkan',
      'first_name.string' => ':attribute tidak valid, masukkan yang benar',
      'first_name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'last_name.required' => ':attribute tidak boleh dikosongkan',
      'last_name.string' => ':attribute tidak valid, masukkan yang benar',
      'last_name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'last_title.string' => ':attribute tidak valid, masukkan yang benar',
      'last_title.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'gender.required' => ':attribute tidak boleh dikosongkan',
      'gender.string' => ':attribute tidak valid, masukkan yang benar',
      'gender.max' => ':attribute terlalu panjang, maksimal :max karakter',
      'gender.in' => ':attribute tidak sesuai pilihan yang disediakan',

      'roles.required' => ':attribute tidak boleh dikosongkan',

      'address.required' => ':attribute tidak boleh dikosongkan',
      'address.string' => ':attribute tidak valid, masukkan yang benar',

      'institution.required' => ':attribute tidak boleh dikosongkan',
      'institution.string' => ':attribute tidak valid, masukkan yang benar',

      'password.required' => ':attribute tidak boleh dikosongkan',
      'password.string' => ':attribute tidak valid, masukkan yang benar',
      'password.min' => ':attribute terlalu pendek, minimal :min karakter',
      'password.confirmed' => ':attribute konfimasi tidak sama',

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :min karakter',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'first_title' => 'Gelar depan',
      'first_name' => 'Nama depan',
      'last_name' => 'Nama belakang',
      'last_title' => 'Gelar belakang',
      'gender' => 'Jenis kelamin',
      'roles' => 'Tipe akun',
      'address' => 'Alamat lengkap',
      'institution' => 'Asal institusi',
      'password' => 'Kata sandi',
      'email' => 'Email',
      'phone' => 'Nomor telepon',
    ];
  }
}
