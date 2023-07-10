<?php

namespace App\Services\Publish;

use LaravelEasyRepository\BaseService;

interface PublishService extends BaseService
{
  public function getPublishesData();
  public function handleCreateData($request);
  public function handleUpdateStatus(int $id);
}
