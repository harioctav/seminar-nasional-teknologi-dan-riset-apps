<?php

namespace App\Http\Controllers\Submissions;

use App\Http\Controllers\Controller;
use App\Services\Certificate\CertificateService;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected CertificateService $certificateService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // 
  }

  /**
   * Print user certificate automatic.
   */
  public function print()
  {
    // 
  }
}
