<?php

namespace App\Http\Controllers\Submissions;

use App\DataTables\Submissions\PublishDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Submissions\PublishRequest;
use App\Models\Publish;
use App\Services\Journal\JournalService;
use App\Services\Publish\PublishService;
use Illuminate\Http\Request;

class PublishController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected PublishService $publishService,
    protected JournalService $journalService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(PublishDataTable $dataTable)
  {
    // dd(auth()->user()->unReadNotifications()->paginate(5));
    return $dataTable->render('publishes.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $journals = $this->journalService->getReadyPublishData()->get();
    return view('publishes.create', compact('journals'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PublishRequest $request)
  {
    $this->publishService->handleCreateData($request);
    return redirect()->route('publishes.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Publish $publish)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Publish $publish)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Publish $publish)
  {
    $this->publishService->handleUpdateStatus($publish->id);
    return response()->json([
      'message' => trans('session.update'),
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Publish $publish)
  {
    //
  }

  /**
   * Change status publish on journal.
   */
  public function status(Publish $publish)
  {
    // 
  }
}
