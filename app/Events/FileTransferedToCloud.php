<?php

namespace App\Events;

use App\Models\TransferFile;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FileTransferedToCloud
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $file;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TransferFile $file)
    {
        $this->file = $file;
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('channel-name');
    }
}
