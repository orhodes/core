<?php

namespace App\Events\Mship\Award;

use App\Events\Event;
use App\Models\Mship\Account\Award;
use Illuminate\Queue\SerializesModels;

class AwardIssued extends Event
{
    use SerializesModels;

    public $award;

    public function __construct(Award $award)
    {
        $this->award = $award;
    }
}
