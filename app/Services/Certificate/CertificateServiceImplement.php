<?php

namespace App\Services\Certificate;

use LaravelEasyRepository\Service;
use App\Repositories\Certificate\CertificateRepository;

class CertificateServiceImplement extends Service implements CertificateService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(CertificateRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
