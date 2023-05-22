<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;
use App\Http\Requests\Auth\RegisterRequest;

interface UserService extends BaseService
{
  public function handleRegisterUsers(Request $request);
}
