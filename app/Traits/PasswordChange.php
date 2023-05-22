<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Settings\PasswordRequest;

trait PasswordChange
{
  /**
   * Show the application's change password form.
   *
   * @return \Illuminate\View\View
   */
  public function showChangePasswordForm(User $user)
  {
    return view('settings.passwords.change', compact('user'));
  }

  public function store(PasswordRequest $request)
  {
    $user = User::findOrFail(me()->id);

    $user->updateOrFail([
      'password' => Hash::make($request->password)
    ]);

    Auth::guard()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return $request->wantsJson() ? new JsonResponse([], 204) : redirect()->route('login')->withSuccess(trans('Berhasil memperbaharui kata sandi anda. Silahkan login ulang.'));
  }
}
