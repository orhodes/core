<?php

namespace App\Models\Mship\Concerns;

use App\Models\Community\Award as Awardable;
use App\Models\Mship\Account\Award;

trait HasAwards
{
    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function award(Awardable $award)
    {
        return $this->awards()->create([
           'account_id' => $this->id,
           'award_id' => $award->id
        ]);
    }
}