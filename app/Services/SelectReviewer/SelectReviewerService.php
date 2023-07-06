<?php

namespace App\Services\SelectReviewer;

use LaravelEasyRepository\BaseService;

interface SelectReviewerService extends BaseService
{
  public function handleCreateData($request);
}
