<?php

namespace App\Services\Journal;

use LaravelEasyRepository\BaseService;

interface JournalService extends BaseService
{
  public function sortByUserId();
  public function handleUploadJournal($request);
}
