<?php

namespace App\Services\Certificate;

use App\Http\Requests\Submissions\CertificateRequest;
use LaravelEasyRepository\BaseService;

interface CertificateService extends BaseService
{
  public function countDataCertificate();
  public function generateCode(string $year);
  public function getDataByUserId(int $user_id);
  public function handleCreateCertificate(CertificateRequest $request);
}
