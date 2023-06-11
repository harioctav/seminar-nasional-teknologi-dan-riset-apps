<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      'users.name',
      'roles.name',
      'clients.name',
      'registrations.name',
      'transactions.name',
      'payments.name',
    ];

    foreach ($items as $name) :
      PermissionCategory::firstOrCreate([
        'name' => $name,
      ]);
    endforeach;
  }
}
