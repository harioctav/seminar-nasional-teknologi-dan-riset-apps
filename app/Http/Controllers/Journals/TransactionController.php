<?php

namespace App\Http\Controllers\Journals;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\DataTables\Scopes\StatusFilter;
use App\Services\Transaction\TransactionService;
use App\DataTables\Journals\TransactionDataTable;
use App\Http\Requests\Journals\TransactionRequest;
use App\Models\User;
use App\Services\Payment\PaymentService;
use App\Services\Registration\RegistrationService;
use App\Services\User\UserService;

class TransactionController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected TransactionService $transactionService,
    protected RegistrationService $registrationService,
    protected PaymentService $paymentService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(TransactionDataTable $dataTable, Request $request)
  {
    $check = $this->registrationService->getAvailableDate();

    if (isRoleName() !== Constant::ADMIN) :
      if ($check->isEmpty()) :
        return view('errors.close-state');
      endif;
    endif;

    return $dataTable->addScope(new StatusFilter($request))->render('journals.transactions.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if (isRoleName() === Constant::ADMIN || isRoleName() === Constant::REVIEWER) :
      abort(403, trans('error.403'));
    endif;

    $user = $this->userService->findOrFail(me()->id);

    if (isRoleName() === Constant::PEMAKALAH) :
      if (!$user->canCreateTransaction()) :
        return redirect()->route('transactions.index')->with('error', trans('error.can_create_transaction'));
      endif;
    endif;

    $payments = $this->paymentService->getActiveStatus()->get();
    $schedules = $this->registrationService->getRegistrationUnpaid($user->id);
    return view('journals.transactions.create', compact('payments', 'schedules'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(TransactionRequest $request)
  {
    $this->transactionService->handleCreateTransaction($request);
    return redirect()->route('transactions.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Transaction $transaction)
  {
    return view('journals.transactions.show', compact('transaction'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Transaction $transaction)
  {
    $this->transactionService->updateStatusTransaction($transaction->id, $request);
    return redirect()->route('transactions.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Transaction $transaction)
  {
    $this->transactionService->handleDeleteTransaction($transaction);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
