<?php

namespace App\Services\Comment;

use App\Helpers\Global\Helper;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Journal\JournalRepository;

class CommentServiceImplement extends Service implements CommentService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $userRepository;
  protected $journalRepository;

  public function __construct(
    UserRepository $userRepository,
    CommentRepository $mainRepository,
    JournalRepository $journalRepository,
  ) {
    $this->mainRepository = $mainRepository;
    $this->userRepository = $userRepository;
    $this->journalRepository = $journalRepository;
  }

  public function handleStoreData($request)
  {
    DB::beginTransaction();
    try {

      // File upload
      if ($request->file('file_revision')) :
        $fileRevision = Storage::putFile('public/pdf/revisions', $request->file('file_revision'));
      else :
        $fileRevision = null;
      endif;

      // Insert to Comment Table
      $validation = $request->validated();
      $validation['user_id'] = $request->user_id;
      $validation['journal_id'] = $request->journal_id;
      $validation['batch'] = Helper::autoNumber('comments', 'batch', 'REV-' . date('Ym'), 3);
      $validation['file_revision'] = $fileRevision;
      $validation['comment'] = $request->comment;

      $return = $this->mainRepository->create($validation);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleDeleteData($comment)
  {
    DB::beginTransaction();
    try {
      // Handle delete image.
      if ($comment->file_revision) :
        Storage::delete($comment->file_revision);
      endif;

      $return = $this->mainRepository->delete($comment->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
