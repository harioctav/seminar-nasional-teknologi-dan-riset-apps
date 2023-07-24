<?php

namespace App\Repositories\Certificate;

use LaravelEasyRepository\Repository;

interface CertificateRepository extends Repository
{
  public function countDataCertificate();
  public function generateCode(string $year);
  public function getDataByUserId(int $user_id);
}
