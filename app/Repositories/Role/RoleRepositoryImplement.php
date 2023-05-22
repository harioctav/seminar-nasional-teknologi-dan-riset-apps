<?php

namespace App\Repositories\Role;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Role;

class RoleRepositoryImplement extends Eloquent implements RoleRepository
{

  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Role $model)
  {
    $this->model = $model;
  }

  public function firstOrCreate($request)
  {
    $this->model->firstOrCreate([
      'name' => $request->name,
    ])->syncPermissions($request->permission);
  }

  public function updateOrFail($id, $request)
  {
    $role = $this->findOrFail($id);
    $role->updateOrFail([
      'name' => $request->name,
    ]);
    return $role->syncPermissions($request->permission);
  }

  public function roleHasPermissions($id)
  {
    $role = $this->findOrFail($id);
    return $role->permissions->pluck('name')->toArray();
  }
}
