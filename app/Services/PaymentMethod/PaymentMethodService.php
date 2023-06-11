<?php

namespace App\Services\PaymentMethod;

use LaravelEasyRepository\BaseService;

interface PaymentMethodService extends BaseService
{
  public function getActivePaymentMethod();
}
