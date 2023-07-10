<?php

namespace App\Services\Journal;

use LaravelEasyRepository\BaseService;

interface JournalService extends BaseService
{
  public function sortByUserId();
  public function getReadyPublishData();
  public function handleUploadJournal($request);
  public function handleUpdateJournal($request, $journal);
  public function handleDeleteJournal($journal);
}
