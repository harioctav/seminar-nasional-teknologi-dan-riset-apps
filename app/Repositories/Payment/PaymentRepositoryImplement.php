<?php

namespace App\Repositories\Payment;

use App\Helpers\Global\Constant;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Payment;

class PaymentRepositoryImplement extends Eloquent implements PaymentRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Payment $model)
  {
    $this->model = $model;
  }

  public function getActiveStatus()
  {
    return $this->model->active();
  }

  public function changeStatus($payment)
  {
    if ($payment->status == Constant::INACTIVE) :
      return $payment->updateOrFail([
        'status' => Constant::ACTIVE,
      ]);
    else :
      return $payment->updateOrFail([
        'status' => Constant::INACTIVE,
      ]);
    endif;
  }
}
