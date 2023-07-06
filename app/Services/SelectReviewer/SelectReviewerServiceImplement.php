<?php

namespace App\Services\SelectReviewer;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\SelectReviewer\SelectReviewerRepository;
use Illuminate\Support\Carbon;

class SelectReviewerServiceImplement extends Service implements SelectReviewerService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(SelectReviewerRepository $mainRepository)
  {
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
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
