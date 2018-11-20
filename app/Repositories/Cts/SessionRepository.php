<?php

namespace App\Repositories\Cts;

use App\Models\Cts\Member;
use App\Models\Cts\Session;
use App\Models\Mship\Account;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SessionRepository
{
    public function byMentor(Account $account)
    {
        $account = Member::findByCoreAccount($account);

        return Session::where('mentor_id', '=', $account->id)
            ->with('member')
            ->get();
    }
}
