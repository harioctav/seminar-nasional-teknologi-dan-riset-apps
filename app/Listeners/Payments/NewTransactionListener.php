<?php

namespace App\Listeners\Payments;

use App\Models\User;
use App\Helpers\Global\Constant;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Payments\NewTransactionEvent;
use App\Notifications\Payments\NewTransactionNotification;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Notification;

class NewTransactionListener
{
  /**
   * Create the event listener.
   */
  public function __construct(
    protected UserRepository $userRepository,
  ) {
    //
  }

  /**
   * Handle the event.
   */
  public function handle(NewTransactionEvent $event): void
  {
    $transaction = $event->transaction;
    $admin = $this->userRepository->getAdminOnly()->get();

    Notification::send($admin, new NewTransactionNotification($transaction));
  }
}
