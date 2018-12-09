<?php

namespace App\Models\Mship\Account;

use App\Events\Mship\Award\AwardIssued;
use App\Models\Model;
use App\Models\Mship\Account;

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
        'award_id',
    ];

    protected static function boot()
    {
        parent::boot();

        self::created([get_called_class(), 'eventCreated']);
    }

    /**
     * @param Award $model
     * @param null $extra
     * @param null $data
     */
    public static function eventCreated($model, $extra = null, $data = null)
    {
        event(new AwardIssued($model));
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
