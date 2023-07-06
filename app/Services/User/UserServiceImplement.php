<?php

namespace App\Services\User;

use Exception;
use InvalidArgumentException;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Client;
use App\Models\User;
use App\Repositories\Client\ClientRepository;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $clientRepository;
  protected $roleService;

  public function __construct(
    RoleService $roleService,
    UserRepository $mainRepository,
    ClientRepository $clientRepository,
  ) {
    $this->mainRepository = $mainRepository;
    $this->clientRepository = $clientRepository;
    $this->roleService = $roleService;
  }

  public function getUserExceptAdmin()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getUserExceptAdmin();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function getReviewerOnly()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getReviewerOnly();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleChangeStatus($id)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->changeStatusUser($id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleRegisterUsers($request)
  {
    DB::beginTransaction();
    try {
      $role = $this->roleService->findOrFail($request->roles);

      if ($request->file('avatar')) :
        $avatar = Storage::putFile('public/images/' . strtolower($role->name), $request->file('avatar'));
      else :
        $avatar = null;
      endif;

      $validated = $request->validated();
      $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
      $validated['avatar'] = $avatar;
      $validated['password'] = $request->roles ? Hash::make(Constant::DEFAULT_PASSWORD) : Hash::make($request->password);
      $validated['status'] = Constant::ACTIVE;

      $user = $this->mainRepository->create($validated);
      $user->assignRole($validated['roles']);

      $data = array();
      $data['user_id'] = $user->id;
      $data['first_title'] = strtoupper($validated['first_title']);
      $data['last_title'] = strtoupper($validated['last_title']);
      $data['first_name'] = $validated['first_name'];
      $data['last_name'] = $validated['last_name'];
      $data['gender'] = $validated['gender'];
      $data['institution'] = strtoupper($validated['institution']);
      $data['address'] = $validated['address'];

      $this->clientRepository->create($data);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $user;
  }

  public function handleCreateNewUser(Request $request)
  {
    DB::beginTransaction();
    try {
      # Handle upload image
      if ($request->file('avatar')) :
        $avatar = Storage::putFile('public/images/reviewers', $request->file('avatar'));
      else :
        $avatar = null;
      endif;

      # Save data into database
      $validation = $request->validated();
      $validation['avatar'] = $avatar;
      $validation['password'] = Hash::make(Constant::DEFAULT_PASSWORD);
      $validation['status'] = Constant::ACTIVE;

      # Sync user to role
      $user = $this->mainRepository->create($validation);
      $user->assignRole($request->roles);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $user;
  }

  public function handleUpdateClientUser(Client $client, $request)
  {
    DB::beginTransaction();
    try {
      # Handle update image
      $role = $this->roleService->findOrFail($request->roles);

      if ($request->file('avatar')) :
        if ($request->fotoLama) :
          Storage::delete($client->user->avatar);
        endif;
        $avatar = Storage::putFile('public/images/' . strtolower($role->name), $request->file('avatar'));
      else :
        $avatar = $request->fotoLama;
      endif;

      $validated = $request->validated();
      $validated['avatar'] = $avatar;
      $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];

      $user = $this->mainRepository->findOrFail($client->user_id);
      $user->update($validated);
      $user->assignRole($validated['roles']);

      $data = array();
      $data['first_title'] = strtoupper($validated['first_title']);
      $data['last_title'] = strtoupper($validated['last_title']);
      $data['first_name'] = $validated['first_name'];
      $data['last_name'] = $validated['last_name'];
      $data['gender'] = $validated['gender'];
      $data['institution'] = strtoupper($validated['institution']);
      $data['address'] = $validated['address'];

      # Update Client
      $this->clientRepository->update($client->id, $data);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }

    DB::commit();
    return $user;
  }

  public function handleUpdateReviewer(User $user, Request $request)
  {
    DB::beginTransaction();
    try {

      # Handle update image
      if ($request->file('avatar')) :
        if ($request->old_avatar) :
          Storage::delete($user->avatar);
        endif;
        $avatar = Storage::putFile('public/images/reviewers', $request->file('avatar'));
      else :
        $avatar = $request->old_avatar;
      endif;

      # Handle update users
      $validation = $request->validated();
      $validation['avatar'] = $avatar;

      $user = $this->mainRepository->update($user->id, $validation);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $user;
  }

  public function handleDeleteUser($user)
  {
    DB::beginTransaction();
    try {

      // Handle delete image.
      if ($user->avatar) :
        Storage::delete($user->avatar);
      endif;

      // Delete user.
      $user = $this->mainRepository->delete($user->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $user;
  }

  public function handleDeleteImage(User $user)
  {
    DB::beginTransaction();
    try {
      Storage::delete($user->avatar);
      $execute = $this->mainRepository->deleteUserAvatar($user->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $execute;
  }
}
