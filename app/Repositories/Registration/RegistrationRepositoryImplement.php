<?php

namespace App\Repositories\Registration;

use App\Helpers\Global\Constant;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Registration;
use Illuminate\Support\Carbon;

class RegistrationRepositoryImplement extends Eloquent implements RegistrationRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Registration $model)
  {
    $this->model = $model;
  }

  public function getAvailableDate()
  {
    return $this->model->all()->filter(function ($item) {
      if (Carbon::now()->between($item->start, $item->end)) {
        return $item;
      }
    })->where('status', Constant::OPEN);
  }

  public function getRegistrationByType()
  {
    return $this->model->where('status', Constant::OPEN)
      ->where('type', Constant::SEMINAR)
      ->get()
      ->filter(function ($item) {
        // Check if the registration is within the valid date range
        if (Carbon::now()->between($item->start, $item->end)) {
          // Check if the registration has at least one paid transaction
          return $item->transaction()->where('status', Constant::APPROVED)->count() > 0;
        }
        return false;
      });
  }

  public function getRegistrationUnpaid(int $user_id)
  {
    return $this->model->where('status', Constant::OPEN)
      ->where('type', Constant::SEMINAR)
      ->get()
      ->filter(function ($item) use ($user_id) {
        // Check if the registration is within the valid date range
        if (Carbon::now()->between($item->start, $item->end)) {
          // Check if the registration does not have any paid transactions
          return $item->transaction()->where('user_id', $user_id)->where('status', Constant::APPROVED)->count() === 0;
        }
        return false;
      });
  }

  public function getRegistrationPaid(int $user_id)
  {
    return $this->model->where('status', Constant::OPEN)
      ->where('type', Constant::SEMINAR)
      ->get()
      ->filter(function ($item) use ($user_id) {
        if (Carbon::now()->between($item->start, $item->end)) {
          return $item->transaction()->where('user_id', $user_id)->where('status', Constant::APPROVED)->count() > 0;
        }
        return false;
      });
  }
}
