<?php

namespace App\Repositories\Journal;

use App\Models\Journal;
use App\Helpers\Global\Constant;
use LaravelEasyRepository\Implementations\Eloquent;

class JournalRepositoryImplement extends Eloquent implements JournalRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Journal $model)
  {
    $this->model = $model;
  }

  public function sortByUserId()
  {
    if (isRoleName() === Constant::PEMAKALAH) :
      return $this->model->where('user_id', me()->id)->latest();
    else :
      return $this->model->latest();
    endif;
  }
}
