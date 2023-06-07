<?php

namespace App\Repositories\Transaction;

use App\Helpers\Global\Constant;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionRepositoryImplement extends Eloquent implements TransactionRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Transaction $model)
  {
    $this->model = $model;
  }

  public function getDataByUserId()
  {
    if (isRoleName() === Constant::PEMAKALAH) :
      return $this->model->where('user_id', me()->id)->latest();
    else :
      return $this->model->latest();
    endif;
  }

  public function updateStatusTransaction(int $id, Request $request, $reason)
  {
    $transaction = $this->findOrFail($id);
    return $transaction->updateOrFail([
      'status' => $request->status,
      'reason' => $reason,
    ]);
  }
}
