<?php

namespace App\Repositories\Role;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface RoleRepository extends Repository
{
  public function firstOrCreate(Request $request);
  public function updateOrFail(int $id, Request $request);
  public function roleHasPermissions(int $id);
}
