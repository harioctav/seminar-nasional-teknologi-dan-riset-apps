<?php

namespace App\Http\Controllers\Users;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\Role\RoleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ClientRequest;
use App\Services\Client\ClientService;
use App\Services\User\UserService;

class ClientController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoleService $roleService,
    protected UserService $userService,
    protected ClientService $clientService,
  ) {
    // 
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = $this->roleService->getRoleWhereNotInAdmin()->get();
    return view('clients.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ClientRequest $request)
  {
    $this->userService->handleRegisterUsers($request);
    return redirect()->route('users.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Client $client)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Client $client)
  {
    $roles = $this->roleService->getRoleWhereNotInAdmin()->get();
    return view('clients.edit', compact('roles', 'client'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ClientRequest $request, Client $client)
  {
    $this->userService->handleUpdateClientUser($client, $request);
    return redirect()->route('users.index')->withSuccess(trans('session.update'));
  }
}
