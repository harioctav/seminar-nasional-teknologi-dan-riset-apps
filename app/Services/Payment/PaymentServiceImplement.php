<?php

namespace App\Services\Payment;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Payment\PaymentRepository;

class PaymentServiceImplement extends Service implements PaymentService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(PaymentRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getActiveStatus()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getActiveStatus();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function changeStatus($payment)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->changeStatus($payment);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
