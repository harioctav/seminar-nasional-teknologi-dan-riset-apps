<?php

namespace App\Repositories\PaymentMethod;

use LaravelEasyRepository\Repository;

interface PaymentMethodRepository extends Repository
{
  public function getActivePaymentMethod();
}
