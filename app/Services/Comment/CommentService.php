<?php

namespace App\Services\Comment;

use LaravelEasyRepository\BaseService;

interface CommentService extends BaseService
{
  public function handleStoreData($request);
  public function handleDeleteData($comment);
}
