<?php

namespace App\Repositories\Certificate;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Certificate;

class CertificateRepositoryImplement extends Eloquent implements CertificateRepository{

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

    // Write something awesome :)
}
