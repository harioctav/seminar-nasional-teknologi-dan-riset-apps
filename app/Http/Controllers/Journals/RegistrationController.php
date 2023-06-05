<?php

namespace App\Http\Controllers\Journals;

use App\DataTables\Journals\RegistrationDataTable;
use App\DataTables\Scopes\StatusFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Journals\RegistrationRequest;
use App\Models\Registration;
use App\Services\Registration\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RegistrationService $registrationService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(RegistrationDataTable $dataTable, Request $request)
  {
    return $dataTable->addScope(new StatusFilter($request))->render('journals.registrations.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('journals.registrations.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RegistrationRequest $request)
  {
    $this->registrationService->create($request->validated());
    return redirect()->route('registrations.index')->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Registration $registration)
  {
    return view('journals.registrations.edit', compact('registration'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RegistrationRequest $request, Registration $registration)
  {
    $this->registrationService->update($registration->id, $request->all());
    return redirect()->route('registrations.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Registration $registration)
  {
    $this->registrationService->delete($registration->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
