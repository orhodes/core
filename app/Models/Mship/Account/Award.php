<?php

namespace App\Models\Mship\Account;

use App\Models\Model;

/**
 * App\Models\Mship\Account\Award
 *
 * @property int $id
 * @property int $account_id
 * @property int $award_id
 */
class Award extends Model
{
    protected $table = 'mship_account_award';

    protected $fillable = [
        'account_id',
        'award_id'
    ];
}
