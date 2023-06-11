<?php

namespace App\Services\Payment;

use LaravelEasyRepository\BaseService;

interface PaymentService extends BaseService
{
  public function changeStatus($payment);
}
