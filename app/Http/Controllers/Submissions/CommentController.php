<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Submissions\CommentRequest;
use App\Models\Comment;
use App\Models\Journal;
use App\Models\User;
use App\Services\Comment\CommentService;
use App\Services\Journal\JournalService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected JournalService $journalService,
    protected CommentService $commentService,
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
  public function store(CommentRequest $request)
  {
    $this->commentService->handleStoreData($request);
    return redirect()->route('journals.show', $request->journal_uuid)->withSuccess('Komentar berhasil di submit');
  }

  /**
   * Display the specified resource.
   */
  public function show(Comment $comment)
  {
    return response()->json($comment);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Comment $comment)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Comment $comment)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Comment $comment)
  {
    $this->commentService->handleDeleteData($comment);
    return response()->json([
      'message' => trans('Komentar Dihapus'),
    ]);
  }
}
