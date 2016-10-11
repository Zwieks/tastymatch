<?php

namespace App\Listeners;

use App\Events\ViewCounter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use DB;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ViewCounter  $event
     * @return void
     */
    public function handle(ViewCounter $post)
    {
        // Get the variable
        $slug = $post->views->slug;

        // Increment the view counter by one if the user not already viewed the blog...
        DB::table('blog')->where('slug', '=', $slug)->increment('views');
    }
}
