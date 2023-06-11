<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Scopes\StatusFilter;
use App\DataTables\Settings\PaymentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\PaymentRequest;
use App\Models\Payment;
use App\Services\Bank\BankService;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected BankService $bankService,
    protected PaymentService $paymentService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request, PaymentDataTable $dataTable)
  {
    return $dataTable->addScope(new StatusFilter($request))
      ->render('settings.payments.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $banks = $this->bankService->all();
    return view('settings.payments.create', compact('banks'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PaymentRequest $request)
  {
    $this->paymentService->create($request->validated());
    return redirect()->route('payments.index')->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Payment $payment)
  {
    $banks = $this->bankService->all();
    return view('settings.payments.edit', compact('payment', 'banks'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(PaymentRequest $request, Payment $payment)
  {
    $this->paymentService->update($payment->id, $request->validated());
    return redirect()->route('payments.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Payment $payment)
  {
    $this->paymentService->delete($payment->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }

  /**
   * Change status the specified resource from storage.
   */
  public function status(Payment $payment)
  {
    $this->paymentService->changeStatus($payment);
    return response()->json([
      'message' => trans('session.status'),
    ]);
  }
}
