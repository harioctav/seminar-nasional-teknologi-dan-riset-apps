<?php

namespace App\Http\Controllers\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\DataTables\Scopes\RolesFilter;
use App\DataTables\Scopes\StatusFilter;
use App\DataTables\Settings\UserDataTable;
use App\Http\Requests\Settings\UserRequest;

class UserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected RoleService $roleService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(UserDataTable $dataTable, Request $request)
  {
    return $dataTable->addScope(new StatusFilter($request))
      ->addScope(new RolesFilter($request))
      ->render('settings.users.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = $this->roleService->getRoleReviewerOnly()->first();
    return view('settings.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    if ($request->roles === Constant::REVIEWER) :
      $this->userService->handleCreateNewUser($request);
    else :
      abort(500, 'Internal Server Error, Silahkan hubungin admin');
    endif;

    return redirect()->route('users.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    // dd($user->client);
    # Cek user role
    if (isRoleName() === Constant::PEMAKALAH || isRoleName() === Constant::PARTICIPANT) :
      return view('settings.users.profiles.client', compact('user'));
    else :
      return view('settings.users.profiles.admin', compact('user'));
    endif;
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    return view('settings.users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, User $user)
  {
    if ($request->roles === Constant::REVIEWER || $request->roles === Constant::ADMIN) :
      $this->userService->handleUpdateReviewer($user, $request);
    else :
      abort(500, 'Internal Server Error, Silahkan hubungin admin');
    endif;

    if (isRoleName() === Constant::REVIEWER) :
      return redirect()->route('users.show', $user->uuid)->withSuccess(trans('session.update'));
    endif;

    return redirect()->route('users.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    $this->userService->handleDeleteUser($user);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }

  /**
   * Change user status from storage.
   */
  public function status(User $user)
  {
    $this->userService->handleChangeStatus($user->id);
    return response()->json([
      'message' => trans('session.status'),
    ]);
  }

  /**
   * Delete user image.
   */
  public function image(User $user)
  {
    if (!$user->avatar) :
      return response()->json([
        'message' => trans('Anda tidak memiliki gambar untuk dihapus'),
      ]);
    endif;

    $this->userService->handleDeleteImage($user);
    return response()->json([
      'message' => trans('Berhasil menghapus gambar'),
    ]);
  }
}
