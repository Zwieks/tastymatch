<?php

namespace App\Events;

use App\Blog;
use App\Foodstand;
use App\Event;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ViewCounter extends Event
{
    use SerializesModels;

    public $post;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        //Add the $post results as object views to the existing object
        $this->views = $post;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
