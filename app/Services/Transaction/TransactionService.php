<?php

namespace App\Services\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface TransactionService extends BaseService
{
  public function getDataByUserId();
  public function handleCreateTransaction(Request $request);
  public function updateStatusTransaction(int $id, Request $request);
  public function handleDeleteTransaction(Transaction $transaction);
}
