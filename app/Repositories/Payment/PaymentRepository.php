<?php

namespace App\Repositories\Payment;

use App\Models\Payment;
use LaravelEasyRepository\Repository;

interface PaymentRepository extends Repository
{
  public function changeStatus($payment);
}
