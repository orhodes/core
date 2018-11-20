<?php

namespace App\Models\Cts;

use App\Models\Mship\Account;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $connection = 'cts';
    protected $attributes = ['old_rts_id' => 0];
    protected $guarded = [];

    public $timestamps = false;
    public $incrementing = false;

    public static function findByCoreAccount(Account $account)
    {
        return self::where('cid', '=', $account->id)->first();
    }
}
