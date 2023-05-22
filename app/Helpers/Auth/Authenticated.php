<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * Get current user login.
 *
 * @return Authenticatable
 */
function me(): Authenticatable
{
  return Auth::user();
}

/**
 * Get role id by user login.
 *
 * @return int
 */
function isRoleId(): int
{
  return me()->roles->implode('id');
}

/**
 * Get role name by user login.
 *
 * @return string
 */
function isRoleName(): string
{
  return me()->roles->implode('name');
}
