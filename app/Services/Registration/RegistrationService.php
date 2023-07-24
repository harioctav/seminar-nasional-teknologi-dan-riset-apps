<?php

namespace App\Services\Registration;

use LaravelEasyRepository\BaseService;

interface RegistrationService extends BaseService
{
  public function getAvailableDate();
  public function getRegistrationByType();
}
