<?php

namespace Fadvi\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DiscussionUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $discussion, $post, $posterName, $postTime;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($discussion, $post, $posterName, $postTime)
    {
        $this->discussion = $discussion;
        $this->post = $post;
        $this->posterName = $posterName;
        $this->postTime = $postTime;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('discussion.' . $this->discussion->id);
    }
}
