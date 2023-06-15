<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::create([
      'name' => 'Joko Anwar',
      'email' => 'reviewer@gmail.com',
      'phone' => '085798888722',
      'email_verified_at' => now(),
      'password' => bcrypt(Constant::DEFAULT_PASSWORD),
      'status' => Constant::ACTIVE,
    ])->assignRole(Constant::REVIEWER);
  }
}
