<?php

namespace App\Services\Publish;

use Exception;
use InvalidArgumentException;
use App\Helpers\Global\Helper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Journal\JournalRepository;
use App\Repositories\Publish\PublishRepository;

class PublishServiceImplement extends Service implements PublishService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $journalRepository;

  public function __construct(
    PublishRepository $mainRepository,
    JournalRepository $journalRepository,
  ) {
    $this->mainRepository = $mainRepository;
    $this->journalRepository = $journalRepository;
  }

  public function handleCreateData($request)
  {
    DB::beginTransaction();
    try {

      // Update status journal
      $journal = $this->journalRepository->findOrFail($request->journal_id);
      $journal->update([
        'is_approved' => true,
      ]);

      $validation = $request->validated();
      $validation['journal_id'] = $journal->id;
      $validation['publish_date'] = Carbon::now()->toDateString();
      $validation['publish_code'] = Helper::autoNumber('publishes', 'publish_code', 'PUB-' . date('Ym'), 3);
      $validation['is_active'] = true;

      // Create publish data
      $return = $this->mainRepository->create($validation);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleUpdateStatus(int $id)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->handleUpdateStatus($id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
