<?php

namespace App\Repositories\Publish;

use App\Helpers\Global\Constant;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Publish;

class PublishRepositoryImplement extends Eloquent implements PublishRepository
{

  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Publish $model)
  {
    $this->model = $model;
  }

  public function handleUpdateStatus(int $id)
  {
    $data = $this->findOrFail($id);

    if ($data->is_active == Constant::ACTIVE) {
      $data->updateOrFail([
        'is_active' => Constant::INACTIVE,
      ]);
    } else {
      $data->updateOrFail([
        'is_active' => Constant::ACTIVE,
      ]);
    }
  }
}
