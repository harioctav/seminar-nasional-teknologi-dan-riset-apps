<?php

namespace App\Repositories\Journal;

use LaravelEasyRepository\Repository;

interface JournalRepository extends Repository
{
  public function sortByUserId();
}
