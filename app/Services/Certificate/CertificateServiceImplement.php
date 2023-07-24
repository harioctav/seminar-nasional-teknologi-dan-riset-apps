<?php

namespace App\Services\Certificate;

use Exception;
use InvalidArgumentException;
use App\Helpers\Global\Helper;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Submissions\CertificateRequest;
use App\Repositories\Certificate\CertificateRepository;
use App\Repositories\Registration\RegistrationRepository;
use Carbon\Carbon;

class CertificateServiceImplement extends Service implements CertificateService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  public function __construct(
    protected UserRepository $userRepository,
    protected CertificateRepository $mainRepository,
    protected RegistrationRepository $registrationRepository,
  ) {
    // 
  }

  public function countDataCertificate()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->countDataCertificate();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function generateCode(string $year)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->generateCode($year);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function getDataByUserId(int $user_id)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getDataByUserId($user_id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleCreateCertificate(CertificateRequest $request)
  {
    DB::beginTransaction();
    try {
      // Add logic
      // Get user & registration data
      $user = $this->userRepository->findOrFail(me()->id);
      $schedule = $this->registrationRepository->findOrFail($request->registration_id);

      // Prepare parameter for certificate
      $name = $user->name;
      $role = $user->isRoleName();
      $date_start = Helper::customDate($schedule->start, false);
      $date_end = Helper::customDate($schedule->end, false);
      $year = $schedule->start->format('Y');
      $number = $this->generateCode($year);

      $path = public_path('assets/images/sertifikat.png');
      $certificate = Image::make($path);

      // Create certificate view
      $certificate->text("No: {$number}", 1765, 870, function ($font) {
        $font->file(public_path('assets/fonts/Times-New-Roman.ttf'));
        $font->size(80);
        $font->align('center');
      });

      $certificate->text($name, 1760, 1130, function ($font) {
        $font->file(public_path('assets/fonts/Times-New-Roman-Bold.ttf'));
        $font->size(80);
        $font->align('center');
      });

      $certificate->text($role, 1760, 1390, function ($font) {
        $font->file(public_path('assets/fonts/Times-New-Roman-Bold.ttf'));
        $font->size(80);
        $font->align('center');
      });

      $certificate->text($year, 2440, 1600, function ($font) {
        $font->file(public_path('assets/fonts/Times-New-Roman.ttf'));
        $font->size(60);
        $font->align('center');
      });

      $certificate->text($date_end, 1910, 1680, function ($font) {
        $font->file(public_path('assets/fonts/Times-New-Roman.ttf'));
        $font->size(60);
      });

      $certificate->text($date_start, 2610, 1960, function ($font) {
        $font->file(public_path('assets/fonts/Times-New-Roman.ttf'));
        $font->size(60);
      });

      // Simpan sertifikat yang telah di-generate ke dalam penyimpanan (storage)
      $unique = uniqid();
      $output_path = 'public/images/certificates/' . $unique . '.png';
      Storage::put($output_path, $certificate->encode());

      $string = "{$name} Semnastera {$unique}-{$year}";
      $download_name = str_replace(' ', '_', $string) . '.png';
      $download_file = storage_path("app/{$output_path}");

      response()->download($download_file, $download_name);

      $data = array();
      $data['code'] = $number;
      $data['generate_date'] = Carbon::now()->toDateString();
      $data['user_id'] = $user->id;
      $data['registration_id'] = $schedule->id;
      $data['image'] = $output_path;

      $return = $this->mainRepository->create($data);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
