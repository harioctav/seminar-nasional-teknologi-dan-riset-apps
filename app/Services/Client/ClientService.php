<?php

namespace App\Services\Client;

use App\Http\Requests\Users\ClientRequest;
use LaravelEasyRepository\BaseService;

interface ClientService extends BaseService
{
  public function handleCreateClient(ClientRequest $request);
}
