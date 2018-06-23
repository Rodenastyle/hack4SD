<?php

namespace App\Events;

use App\House;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CreateHouse
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $house;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(House $house)
    {
        $this->house = $house;
    }
}
