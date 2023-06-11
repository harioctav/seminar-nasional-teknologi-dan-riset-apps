<?php

namespace App\Services\Bank;

use LaravelEasyRepository\Service;
use App\Repositories\Bank\BankRepository;

class BankServiceImplement extends Service implements BankService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(BankRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
