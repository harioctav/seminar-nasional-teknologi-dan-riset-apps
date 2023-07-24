<?php

namespace App\Services\Registration;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Registration\RegistrationRepository;

class RegistrationServiceImplement extends Service implements RegistrationService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(RegistrationRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getAvailableDate()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getAvailableDate();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function getRegistrationByType()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getRegistrationByType();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function getRegistrationUnpaid(int $user_id)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getRegistrationUnpaid($user_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function getRegistrationPaid(int $user_id)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getRegistrationPaid($user_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
