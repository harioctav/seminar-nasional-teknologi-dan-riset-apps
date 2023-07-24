<?php

namespace App\Services\Registration;

use LaravelEasyRepository\BaseService;

interface RegistrationService extends BaseService
{
  public function getAvailableDate();
  public function getRegistrationByType();
  public function getRegistrationUnpaid(int $user_id);
  public function getRegistrationPaid(int $user_id);
}
