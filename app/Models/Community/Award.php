<?php

namespace App\Models\Community;

use App\Models\Model;
use App\Models\Mship\Account;

/**
 * App\Models\Mship\Account\Award
 *
 * @property int $id
 * @property int $awardable_type
 * @property int $awardable_id
 * @property int $forum_id
 */
class Award extends Model
{
    protected $table = 'community_awards';

    public function awardable()
    {
        return $this->morphTo();
    }

    protected function accounts()
    {
        return $this->belongsToMany(Account::class, 'mship_account_award');
    }
}
