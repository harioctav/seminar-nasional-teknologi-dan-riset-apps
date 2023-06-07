<?php

namespace App\Repositories\Transaction;

use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface TransactionRepository extends Repository
{
  public function getDataByUserId();
  public function updateStatusTransaction(int $id, Request $request, $reason);
}
