<?php

namespace App\Services\User;

use Exception;
use InvalidArgumentException;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Client\ClientRepository;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $clientRepository;

  public function __construct(
    UserRepository $mainRepository,
    ClientRepository $clientRepository,
  ) {
    $this->mainRepository = $mainRepository;
    $this->clientRepository = $clientRepository;
  }

  public function handleRegisterUsers($request)
  {
    DB::beginTransaction();
    try {
      $validated = $request->validated();
      $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];
      $validated['password'] = $request->roles ? Hash::make(Constant::DEFAULT_PASSWORD) : Hash::make($request->password);
      $validated['status'] = Constant::ACTIVE;

      $user = $this->mainRepository->create($validated);
      $user->assignRole($validated['roles']);

      $data = array();
      $data['user_id'] = $user->id;
      $data['first_title'] = $validated['first_title'];
      $data['last_title'] = $validated['last_title'];
      $data['first_name'] = $validated['first_name'];
      $data['last_name'] = $validated['last_name'];
      $data['gender'] = $validated['gender'];
      $data['institution'] = $validated['institution'];
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
}
