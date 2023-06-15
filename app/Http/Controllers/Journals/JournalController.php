<?php

namespace App\Http\Controllers\Journals;

use App\Models\Journal;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Services\Journal\JournalService;
use App\DataTables\Journals\JournalDataTable;
use App\Http\Requests\Journals\JorunalRequest;

class JournalController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected JournalService $journalService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(JournalDataTable $dataTable)
  {
    return $dataTable->render('journals.journals.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if (isRoleName() === Constant::ADMIN)
      abort(403, trans('error.403'));

    if (isRoleName() === Constant::REVIEWER)
      abort(403, trans('error.403'));

    if (isRoleName() === Constant::PARTICIPANT)
      abort(403, trans('error.403'));

    return view('journals.journals.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(JorunalRequest $request)
  {
    $this->journalService->handleUploadJournal($request);
    return redirect()->route('journals.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Journal $journal)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Journal $journal)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Journal $journal)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Journal $journal)
  {
    //
  }
}
