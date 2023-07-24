<?php

namespace App\Repositories\Registration;

use LaravelEasyRepository\Repository;

interface RegistrationRepository extends Repository
{
  public function getAvailableDate();
  public function getRegistrationByType();
  public function getRegistrationUnpaid(int $user_id);
  public function getRegistrationPaid(int $user_id);
}
