<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Submissions\SelectReviewerRequest;
use App\Models\SelectReviewer;
use App\Services\SelectReviewer\SelectReviewerService;
use Illuminate\Http\Request;

class SelectReviewerController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected SelectReviewerService $selectReviewerService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(SelectReviewerRequest $request)
  {
    $this->selectReviewerService->handleCreateData($request);
    return redirect()->route('journals.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(SelectReviewer $selectReviewer)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(SelectReviewer $selectReviewer)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, SelectReviewer $selectReviewer)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(SelectReviewer $selectReviewer)
  {
    //
  }
}
