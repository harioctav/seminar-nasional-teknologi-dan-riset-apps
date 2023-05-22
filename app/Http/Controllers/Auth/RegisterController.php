<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Services\Role\RoleService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
  use RedirectsUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected RoleService $roleService,
  ) {
    $this->middleware('guest');
  }

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\View\View
   */
  public function showRegistrationForm(): View
  {
    $roles = $this->roleService->getRoleWhereNotInAdmin()->get();
    return view('auth.register', compact('roles'));
  }

  /**
   * Handle a registration request for the application.
   */
  public function register(RegisterRequest $request): RedirectResponse
  {
    event(
      new Registered(
        $user = $this->userService->handleRegisterUsers($request)
      )
    );

    $this->guard()->login($user);
    if ($response = $this->registered($request, $user)) {
      return $response;
    }

    return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
  }

  /**
   * Get the guard to be used during registration.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return Auth::guard();
  }

  /**
   * The user has been registered.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  mixed  $user
   * @return mixed
   */
  protected function registered(Request $request, $user)
  {
    //
  }
}
