<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Traits\PasswordChange;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
  use PasswordChange;
}
