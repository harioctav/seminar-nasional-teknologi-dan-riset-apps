<?php

namespace App\Services\SelectReviewer;

use App\Notifications\Submissions\NewJournalNotification;
use App\Notifications\Submissions\ReviewerForJournalNotification;
use App\Notifications\Submissions\ReviewerSelectedNotification;
use App\Repositories\Journal\JournalRepository;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\SelectReviewer\SelectReviewerRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class SelectReviewerServiceImplement extends Service implements SelectReviewerService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(
    SelectReviewerRepository $mainRepository,
    protected UserRepository $userRepository,
    protected JournalRepository $journalRepository
  ) {
    $this->mainRepository = $mainRepository;
  }

  public function handleCreateData($request)
  {
    DB::beginTransaction();
    try {
      $validated = $request->validated();
      $validated['select_by'] = me()->name;
      $validated['select_date'] = Carbon::now()->toDateString();

      $return = $this->mainRepository->create($validated);

      // Send notifications to user
      $user = $this->userRepository->findOrFail($return->journal->user->id);
      $reviewer = $this->userRepository->findOrFail($return->user->id);
      Notification::send($user, new ReviewerSelectedNotification($return));
      Notification::send($reviewer, new ReviewerForJournalNotification($return));
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
