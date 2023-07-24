<?php

namespace App\Services\Transaction;

use Exception;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Helpers\Global\Helper;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Notification;
use App\Repositories\Transaction\TransactionRepository;
use App\Notifications\Payments\NewTransactionNotification;
use App\Notifications\Transactions\PaymentNotification;
use App\Repositories\Certificate\CertificateRepository;
use App\Services\Registration\RegistrationService;

class TransactionServiceImplement extends Service implements TransactionService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  public function __construct(
    protected UserRepository $userRepository,
    protected TransactionRepository $mainRepository,
    protected CertificateRepository $certificateRepository,
    protected RegistrationService $registrationService,
  ) {
    // 
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

      $registration = $this->registrationService->findOrFail($request->registration_id);

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
      $bayar = Helper::getRupiah($nominal);
      $activity_name = $registration->title;
      $activity_date = Helper::customDate($registration->start);

      $validation = $request->validated();
      $validation['proof'] = $proof;
      $validation['amount'] = $nominal;
      $validation['upload_date'] = Carbon::now()->toDateString();
      $validation['user_id'] = me()->id;
      $date = Helper::customDate($validation['upload_date']);
      $validation['description'] = "Saya melakukan pembayaran sebesar {$bayar} pada hari {$date} untuk kegiatan {$activity_name} yang diselenggarakan pada {$activity_date}";

      $return = $this->mainRepository->create($validation);

      // Send Notif Dropdown to Admin
      $admin = $this->userRepository->getAdminOnly()->get();
      Notification::send($admin, new NewTransactionNotification($return));
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

      // Send Notif to users
      $transaction = $this->mainRepository->findOrFail($id);

      // Get user dari pemilik transaksi
      $user = $this->userRepository->findOrFail($transaction->user->id);

      // Send notif to user
      Notification::send($user, new PaymentNotification($transaction));
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
