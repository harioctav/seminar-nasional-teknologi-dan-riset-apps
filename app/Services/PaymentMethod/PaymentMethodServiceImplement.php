<?php

namespace App\Services\PaymentMethod;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Helpers\Global\Constant;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\PaymentMethod\PaymentMethodRepository;

class PaymentMethodServiceImplement extends Service implements PaymentMethodService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(PaymentMethodRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getActivePaymentMethod()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getActivePaymentMethod();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
