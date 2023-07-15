<?php

namespace App\Notifications\Payments;

use App\Helpers\Global\Helper;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewTransactionNotification extends Notification implements ShouldQueue
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(
    public Transaction $transaction
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
    return ['database', 'broadcast'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->line('The introduction to the notification.')
      ->action('Notification Action', url('/'))
      ->line('Thank you for using our application!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    $user_name = $this->transaction->user->name;
    $amount = Helper::getRupiah($this->transaction->amount);

    return [
      'transaction_amount' => $amount,
      'transaction_user' => $user_name,
      'message' => "{$user_name} telah melakukan pembayaran sebesar {$amount}",
    ];
  }

  public function toBroadcast(object $notifiable): BroadcastMessage
  {
    return new BroadcastMessage($this->toArray($notifiable));
  }
}
