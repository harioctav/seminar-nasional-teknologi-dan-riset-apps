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
}
