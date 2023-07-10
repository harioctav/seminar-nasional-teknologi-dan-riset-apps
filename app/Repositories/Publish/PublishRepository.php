<?php

namespace App\Repositories\Publish;

use LaravelEasyRepository\Repository;

interface PublishRepository extends Repository
{
  public function handleUpdateStatus(int $id);
}
