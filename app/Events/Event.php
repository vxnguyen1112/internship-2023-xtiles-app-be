<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Event implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $id;
    public $object;

    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Create a new event instance.
     */
    public function create($action, $object, $id, $data)
    {
        $this->message = [
            'event' => "{$action}-{$object}",
            'data' => $data
        ];
        $this->id = $id;
        return $this;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn(): Channel
    {
        return new Channel("channel-{$this->object}-{$this->id}");
    }

    public function broadcastAs()
    {
        return "join.{$this->object}";
    }
}
