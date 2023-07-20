<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
  ) {
    // 
  }

  public function index()
  {
    $user = $this->userService->findOrFail(me()->id);
    $notifications = $user->notifications()->latest()->get();

    return response()->json($notifications);
  }

  public function update(Request $request, $id)
  {
    $user = $this->userService->findOrFail(me()->id);
    $notification = $user->notifications()->findOrFail($id);
    $notification->markAsRead();

    return response()->json(['success' => true]);
  }
}
