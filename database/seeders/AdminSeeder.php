<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // User Admin
    User::create([
      'name' => Constant::ADMIN,
      'email' => 'admin@gmail.com',
      'phone' => '085798888733',
      'email_verified_at' => now(),
      'password' => bcrypt(Constant::DEFAULT_PASSWORD),
      'status' => Constant::ACTIVE
    ])->assignRole(Constant::ADMIN);
  }
}
