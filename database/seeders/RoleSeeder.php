<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use App\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    // Role Name
    $datas = [
      Constant::ADMIN,
      Constant::REVIEWER,
      Constant::PEMAKALAH,
      Constant::PARTICIPANT,
    ];

    foreach ($datas as $data) :
      $roles = Role::create([
        'name' => $data,
        'guard_name' => 'web'
      ]);
    endforeach;

    $pemakalah = $roles->where('name', Constant::PEMAKALAH)->first();
    $pemakalah->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->get()
    );

    $reviewer = $roles->where('name', Constant::REVIEWER)->first();
    $reviewer->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->get()
    );

    $participant = $roles->where('name', Constant::PARTICIPANT)->first();
    $participant->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->get()
    );
  }
}
