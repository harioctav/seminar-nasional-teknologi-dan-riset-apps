<?php

namespace App\Services\Registration;

use LaravelEasyRepository\Service;
use App\Repositories\Registration\RegistrationRepository;

class RegistrationServiceImplement extends Service implements RegistrationService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(RegistrationRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
