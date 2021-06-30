<?php

namespace Areaseb\Estate\Events;

use Areaseb\Estate\Models\Privacy;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrivacyCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Privacy generated
     */
    public $privacy;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Privacy $privacy)
    {
        $this->privacy = $privacy;
    }
}
