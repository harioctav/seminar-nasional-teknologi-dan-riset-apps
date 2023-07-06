<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;
use App\Models\Client;

interface UserService extends BaseService
{
  public function getReviewerOnly();
  public function getUserExceptAdmin();
  public function handleChangeStatus(int $id);
  public function handleRegisterUsers(Request $request);
  public function handleCreateNewUser(Request $request);
  public function handleUpdateReviewer(User $user, Request $request);
  public function handleUpdateClientUser(Client $client, Request $request);
  public function handleDeleteUser(User $user);
  public function handleDeleteImage(User $user);
}
