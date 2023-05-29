<?php

namespace App\Http\Requests\Users;

use Illuminate\Validation\Rule;
use App\Helpers\Global\Constant;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
    $method = $this->method();
    $user_id = $this->client->user_id;

    return [
      'first_title' => 'nullable|string|max:5',
      'first_name' => 'required|string|max:20',
      'last_name' => 'required|string|max:20',
      'last_title' => 'nullable|string|max:5',
      'gender' => 'required|in:' . Constant::MALE . ',' . Constant::FEMALE . '',
      'roles' => 'required',
      'address' => 'required|string',
      'institution' => 'required|string',
      'avatar' => 'nullable|mimes:jpg,png|max:3048',
      'email' => [
        'required', 'email',
        $method === Constant::POST ? Rule::unique('users', 'email') : Rule::unique('users', 'email')->ignore($user_id),
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        $method === Constant::POST ? Rule::unique('users', 'phone') : Rule::unique('users', 'phone')->ignore($user_id),
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

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :min karakter',

      'avatar.image' => ':attribute tidak valid, pastikan memilih gambar',
      'avatar.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'avatar.max' => ':attribute terlalu besar, maksimal :max kb',
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
      'email' => 'Email',
      'phone' => 'Nomor telepon',
      'avatar' => 'Foto profil',
    ];
  }
}
