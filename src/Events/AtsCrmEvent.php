<?php

namespace SimonProud\Lamegats\Events;


use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class AtsCrmEvent
{
    use SerializesModels;

    public $event;

    public $type;

    /**
     * Create a new event instance.
     *
     * @param $event
     * @param $type
     */
    public function __construct($event, $type)
    {
        $this->event = $event;
        $this->type = $type;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['*'];
    }

    public function broadcastAs()
    {
        return 'megafon.event';
    }
}
