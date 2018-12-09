<?php

namespace App\Listeners\Sync\Awards;

use App\Events\Mship\Award\AwardIssued;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncAwardsToForum implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  AwardIssued $event
     * @return void
     */
    public function handle(AwardIssued $event)
    {
        $account = $event->award->account;

        // TODO: Add awards to forum.
    }
}
