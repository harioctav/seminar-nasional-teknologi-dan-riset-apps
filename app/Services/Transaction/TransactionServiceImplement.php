<?php

namespace App\Services\Transaction;

use App\Events\Payments\NewTransactionEvent;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Helpers\Global\Constant;
use App\Models\Transaction;
use App\Notifications\Payments\NewTransactionNotification;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Notification;

class TransactionServiceImplement extends Service implements TransactionService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $userRepository;

  public function __construct(
    UserRepository $userRepository,
    TransactionRepository $mainRepository,
  ) {
    $this->mainRepository = $mainRepository;
    $this->userRepository = $userRepository;
  }

  public function getDataByUserId()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getDataByUserId();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleCreateTransaction(Request $request)
  {
    DB::beginTransaction();
    try {

      $amount = $request->amount;
      $nominal = str_replace(',', '', $amount);

      if ($nominal !== '55000') :
        return back()->with('error', trans('Nominal harus atau sama dengan Rp. 55,000'));
      endif;

      // Jika ada gambar yang diupload
      if ($request->file('proof')) :
        $proof = Storage::putFile('public/images/proofs', $request->file('proof'));
      else :
        $proof = null;
      endif;

      /**
       * Tangkap input yang sudah tervalidasi.
       * Masukkan ke dalam variable dengan bentuk array dan simpan nama foto di database.
       */
      $validation = $request->validated();
      $validation['proof'] = $proof;
      $validation['amount'] = $nominal;
      $validation['upload_date'] = now()->format('Y-m-d');
      $validation['user_id'] = me()->id;

      $return = $this->mainRepository->create($validation);

      // Send Notif Dropdown to Admin
      event(new NewTransactionEvent($return));
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function updateStatusTransaction(int $id, Request $request)
  {
    DB::beginTransaction();
    try {
      // Jika Status Reject
      if ($request->status !== Constant::REJECTED) :
        $reason = null;
      else :
        $reason = $request->reason;
      endif;

      $return = $this->mainRepository->updateStatusTransaction($id, $request, $reason);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleDeleteTransaction(Transaction $transaction)
  {
    DB::beginTransaction();
    try {
      // Hapus foto lama.
      if ($transaction->proof) :
        Storage::delete($transaction->proof);
      endif;

      $return = $this->mainRepository->delete($transaction->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
