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
    for ($i = 1; $i <= 5; $i++) :
      $reviewers = User::factory()->create();
      $reviewers->assignRole(Constant::REVIEWER);
    endfor;
  }
}
