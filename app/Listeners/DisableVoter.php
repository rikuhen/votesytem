<?php

namespace App\Listeners;

use App\Events\VoteRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DisableVoter
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
     * @param  VoteRegistered  $event
     * @return void
     */
    public function handle(VoteRegistered $event)
    {
        if($event->user){
            $user = $event->user;
            $user->enabled = 0;
            $user->update();
        }
    }
}
