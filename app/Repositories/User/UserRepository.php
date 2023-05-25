<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
  public function getUserExceptAdmin();
  public function changeStatusUser(int $id);
}
