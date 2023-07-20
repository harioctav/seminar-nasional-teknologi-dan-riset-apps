<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Global\Dashboard;
use App\Services\User\UserService;
use App\Services\Journal\JournalService;
use App\Services\Publish\PublishService;
use App\Services\Transaction\TransactionService;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected PublishService $publishService,
    protected JournalService $journalService,
    protected TransactionService $transactionService,
  ) {
    $this->middleware(['auth', 'verified']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $reviewerActive = $this->userService->getReviewerOnly()->count();
    $publishesJournal = $this->publishService->getPublishesData()->count();
    $totalUser = $this->userService->getUserExceptAdmin()->count();

    return view('home', compact(
      'reviewerActive',
      'publishesJournal',
      'totalUser',
    ));
  }
}
