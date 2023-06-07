<?php

namespace App\Repositories\Registration;

use LaravelEasyRepository\Repository;

interface RegistrationRepository extends Repository
{
  public function getAvailableDate();
}
