<?php

namespace App\Models\Concerns;

use App\Models\Community\Award;

trait Awardable
{
    public function award()
    {
        return $this->morphOne(Award::class, 'awardable');
    }
}