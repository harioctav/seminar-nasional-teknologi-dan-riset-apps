<?php

namespace App\Notifications\Transactions;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use App\Helpers\Global\Helper;
use App\Helpers\Global\Constant;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentNotification extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(
    protected Transaction $transaction
  ) {
    //
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['database', 'mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->greeting("Hello, {$this->transaction->user->name}")
      ->line('Berikut adalah status pembayaran yang sudah anda lakukan.')
      ->line($this->myCustomMessage())
      ->action('Detail Transaksi Anda', route('transactions.show', $this->transaction->uuid))
      ->line('Terimakasih sudah berpartisipasi dalam acara kami dan semoga sukses selalu!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      'message' => $this->myCustomMessage(),
    ];
  }

  protected function myCustomMessage()
  {
    $date = Helper::customDate($this->transaction->upload_date);
    $activity_name = $this->transaction->registration->title;
    $activity_date = Helper::customDate($this->transaction->registration->start);

    if ($this->transaction->status === Constant::APPROVED) :
      $message = "Transaksi anda pada {$date} untuk acara {$activity_name} yang diselenggarakan pada {$activity_date} sudah di terima oleh " . Constant::ADMIN;
    elseif ($this->transaction->status === Constant::REJECTED) :
      $message = "Transaksi anda pada {$date} untuk acara {$activity_name} yang diselenggarakan pada {$activity_date} di tolak oleh " . Constant::ADMIN . " (Lihat detailnya di halaman transaksi)";
    else :
      $message = "Transaksi anda pada {$date} untuk acara {$activity_name} yang diselenggarakan pada {$activity_date} masih pending, mohon untuk menunggu sampai statusnya berubah";
    endif;

    return $message;
  }
}
