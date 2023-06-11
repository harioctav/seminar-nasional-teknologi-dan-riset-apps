<?php

namespace App\Repositories\PaymentMethod;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\PaymentMethod;

class PaymentMethodRepositoryImplement extends Eloquent implements PaymentMethodRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(PaymentMethod $model)
  {
    $this->model = $model;
  }

  public function getActivePaymentMethod()
  {
    return $this->model->active();
  }
}
