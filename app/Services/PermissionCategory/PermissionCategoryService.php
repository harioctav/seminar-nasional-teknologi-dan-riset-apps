<?php

namespace App\Services\PermissionCategory;

use LaravelEasyRepository\BaseService;

interface PermissionCategoryService extends BaseService
{
  public function with(array $with = []);
}
