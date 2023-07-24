<?php

namespace App\Repositories\Certificate;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Certificate;

class CertificateRepositoryImplement extends Eloquent implements CertificateRepository
{

  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Certificate $model)
  {
    $this->model = $model;
  }

  public function getDataByUserId(int $user_id)
  {
    return $this->model->where('user_id', $user_id);
  }

  public function generateCode(string $year)
  {
    return $this->model->generateCode($year);
  }
}
