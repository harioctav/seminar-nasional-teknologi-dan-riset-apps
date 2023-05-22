<?php

namespace App\Http\Controllers\Settings;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\Role\RoleService;
use App\Http\Controllers\Controller;
use App\DataTables\Settings\RoleDataTable;
use App\Http\Requests\Settings\RoleRequest;
use App\Services\PermissionCategory\PermissionCategoryService;

class RoleController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoleService $roleService,
    protected PermissionCategoryService $permissionCategoryService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(RoleDataTable $dataTable)
  {
    return $dataTable->render('settings.roles.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $permissions = $this->permissionCategoryService->with(['permissions'])->get();
    return view('settings.roles.create', compact('permissions'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RoleRequest $request)
  {
    $this->roleService->firstOrCreate($request);
    return redirect()->route('roles.index')->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Role $role)
  {
    $rolePermissions = $this->roleService->roleHasPermissions($role->id);
    $permissions = $this->permissionCategoryService->with(['permissions'])->get();
    return view('settings.roles.edit', compact('role', 'rolePermissions', 'permissions'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Role $role)
  {
    $this->roleService->updateOrFail($role->id, $request);
    return redirect()->route('roles.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Role $role)
  {
    $this->roleService->delete($role->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
