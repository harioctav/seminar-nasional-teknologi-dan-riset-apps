<?php

namespace App\Events\Payments;

use App\Models\Transaction;
use App\Helpers\Global\Helper;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewTransactionEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $transaction;

  /**
   * Create a new event instance.
   */
  public function __construct(
    Transaction $transaction,
  ) {
    $this->transaction = $transaction;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return array<int, \Illuminate\Broadcasting\Channel>
   */
  public function broadcastOn(): array
  {
    return [
      new PrivateChannel('admin-channel'),
    ];
  }

  public function broadcastAs()
  {
    return 'admin-notifications';
  }

  public function broadcastWith()
  {
    return [
      'message' => "{$this->transaction->user->name} telah melakukan pembayaran sebesar " . Helper::getRupiah($this->transaction->amount),
    ];
  }
}
