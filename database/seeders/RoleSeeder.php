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
        ->orWhere('name', 'LIKE', 'users.notifications')
        ->orWhere('name', 'LIKE', 'users.image')
        ->orWhere('name', 'LIKE', 'client.update')
        ->orWhere('name', 'LIKE', 'transactions.index')
        ->orWhere('name', 'LIKE', 'transactions.create')
        ->orWhere('name', 'LIKE', 'transactions.store')
        ->orWhere('name', 'LIKE', 'transactions.show')
        ->orWhere('name', 'LIKE', 'transactions.update')
        ->orWhere('name', 'LIKE', 'payments.show')
        ->orWhere('name', 'LIKE', 'journals.index')
        ->orWhere('name', 'LIKE', 'journals.create')
        ->orWhere('name', 'LIKE', 'journals.store')
        ->orWhere('name', 'LIKE', 'journals.show')
        ->orWhere('name', 'LIKE', 'journals.edit')
        ->orWhere('name', 'LIKE', 'journals.update')
        ->orWhere('name', 'LIKE', 'comments.store')
        ->orWhere('name', 'LIKE', 'comments.destroy')
        ->orWhere('name', 'LIKE', 'certificates.index')
        ->orWhere('name', 'LIKE', 'certificates.print')
        ->orWhere('name', 'LIKE', 'publishes.index')
        ->orWhere('name', 'LIKE', 'notifications.index')
        ->orWhere('name', 'LIKE', 'notifications.update')
        ->get()
    );

    $reviewer = $roles->where('name', Constant::REVIEWER)->first();
    $reviewer->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->orWhere('name', 'LIKE', 'users.notifications')
        ->orWhere('name', 'LIKE', 'journals.index')
        ->orWhere('name', 'LIKE', 'journals.show')
        ->orWhere('name', 'LIKE', 'comments.store')
        ->orWhere('name', 'LIKE', 'comments.destroy')
        ->orWhere('name', 'LIKE', 'publishes.index')
        ->orWhere('name', 'LIKE', 'notifications.index')
        ->orWhere('name', 'LIKE', 'notifications.update')
        ->get()
    );

    $participant = $roles->where('name', Constant::PARTICIPANT)->first();
    $participant->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->orWhere('name', 'LIKE', 'users.notifications')
        ->orWhere('name', 'LIKE', 'certificates.index')
        ->orWhere('name', 'LIKE', 'certificates.print')
        ->orWhere('name', 'LIKE', 'publishes.index')
        ->orWhere('name', 'LIKE', 'notifications.index')
        ->orWhere('name', 'LIKE', 'notifications.update')
        ->get()
    );
  }
}
