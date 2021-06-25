<?php

namespace Areaseb\Estate\Events;

use Areaseb\Estate\Models\Sheet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SheetCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Sheet generated
     */
    public $sheet;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Sheet $sheet)
    {
        $this->sheet = $sheet;
    }
}
