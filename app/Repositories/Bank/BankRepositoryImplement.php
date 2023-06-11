<?php

namespace App\Repositories\Bank;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Bank;

class BankRepositoryImplement extends Eloquent implements BankRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Bank $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
