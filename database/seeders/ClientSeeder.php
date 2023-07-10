<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $pemakalah_satu = User::create([
      'name' => 'Sarah Ardhelia',
      'email' => 'sarah@gmail.com',
      'phone' => '085659466622',
      'email_verified_at' => now(),
      'password' => bcrypt(Constant::DEFAULT_PASSWORD),
      'status' => Constant::ACTIVE,
    ])->assignRole(Constant::PEMAKALAH);

    Client::create([
      'user_id' => $pemakalah_satu->id,
      'first_name' => 'Sarah',
      'last_name' => 'Ardhelia',
      'gender' => Constant::FEMALE,
      'institution' => strtoupper('Politeknik Sukabumi'),
      'address' => 'Jl. Perintis Kemerdekaan No. 130 Kec. Cibadak, Kab. Sukabumi, Jawa Barat Indonesia 43351',
    ]);

    $pemakalah_dua = User::create([
      'name' => 'Sari Novitasari',
      'email' => 'sari@gmail.com',
      'phone' => '085659466600',
      'email_verified_at' => now(),
      'password' => bcrypt(Constant::DEFAULT_PASSWORD),
      'status' => Constant::ACTIVE,
    ])->assignRole(Constant::PEMAKALAH);

    Client::create([
      'user_id' => $pemakalah_dua->id,
      'first_name' => 'Sari',
      'last_name' => 'Novitasari',
      'gender' => Constant::FEMALE,
      'institution' => strtoupper('Politeknik Sukabumi'),
      'address' => '176, Jalan Selabintana No. 176, Warnasari, Sukamekar, Jawa Barat, Sukabumi, 43114',
    ]);
  }
}
