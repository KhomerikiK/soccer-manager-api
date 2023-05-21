<?php

namespace App\Events;

use App\Models\Country;
use Illuminate\Auth\Events\Registered;
use Illuminate\Broadcasting\PrivateChannel;

class UserRegistered extends Registered
{
    /**
     * Create a new event instance.
     */
    public function __construct(
        public $user,
        public Country $country,
        public string $teamName,
    ) {
        parent::__construct($this->user);

        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
