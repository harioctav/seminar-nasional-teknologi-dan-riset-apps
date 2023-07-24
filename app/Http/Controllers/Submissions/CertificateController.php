<?php

namespace App\Http\Controllers\Submissions;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Helpers\Global\Helper;
use App\Helpers\Global\Constant;
use App\Services\User\UserService;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Services\Certificate\CertificateService;
use App\Services\Registration\RegistrationService;
use App\DataTables\Submissions\CertificateDataTable;
use App\Http\Requests\Submissions\CertificateRequest;

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
    if (isRoleName() === Constant::ADMIN || isRoleName() === Constant::REVIEWER) :
      abort(403, trans('error.403'));
    endif;

    $schedules = $this->registrationService->getRegistrationPaid(me()->id);
    return view('certificates.create', compact('schedules'));
  }

  public function store(CertificateRequest $request)
  {
    $user = $this->userService->findOrFail(me()->id);

    // Cek
    if (Helper::canPrintCertificate($user->id, $request->registration_id)) :
      $this->certificateService->handleCreateCertificate($request);
    else :
      return redirect()->route('certificates.index')->with('error', 'Anda sudah melakukan cetak sertifikat pada Acara tersebut, tidak bisa duplikat');
    endif;

    return redirect()->route('certificates.index')->with('success', 'Sertifikat berhasil di generate');
  }
}
