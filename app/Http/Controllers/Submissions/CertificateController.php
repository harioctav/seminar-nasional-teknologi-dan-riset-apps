<?php

namespace App\Http\Controllers\Submissions;

use App\DataTables\Submissions\CertificateDataTable;
use App\Helpers\Global\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Submissions\CertificateRequest;
use App\Models\Certificate;
use Intervention\Image\Facades\Image;
use App\Services\Certificate\CertificateService;
use App\Services\Registration\RegistrationService;
use App\Services\User\UserService;

class CertificateController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected CertificateService $certificateService,
    protected RegistrationService $registrationService,
  ) {
    # code...
  }

  /**
   * Display a listing of the resource.
   */
  public function index(CertificateDataTable $dataTable)
  {
    return $dataTable->render('certificates.index');
  }

  /**
   * Print user certificate automatic.
   */
  public function create()
  {
    $users = $this->userService->getUserWhereHasTransaction()->get();
    $schedules = $this->registrationService->getRegistrationByType();
    return view('certificates.create', compact('users', 'schedules'));
  }

  public function store(CertificateRequest $request)
  {
    $this->certificateService->handleCreateCertificate($request);
    return redirect()->route('certificates.index')->with('success', 'Sertifikat berhasil di generate');
  }
}
