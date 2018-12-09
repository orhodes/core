<?php

namespace Tests\Feature\Community;

use App\Models\Community\Award;
use App\Models\Mship\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AwardsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_returns_available_awards()
    {
        $before = Award::all()->count();

        factory(Award::class)->create();

        $this->assertEquals($before + 1, Award::all()->count());
    }

    /** @test */
    public function it_associates_awards_to_an_account()
    {
        $award = factory(Award::class)->create();
        $account = factory(Account::class)->create();

        $this->assertCount(0, $account->awards);

        $account->award($award);

        $this->assertCount(1, $account->fresh()->awards);
    }

    /** @test */
    public function it_returns_all_accounts_that_have_an_award()
    {
        $award = factory(Award::class)->create();
        $account = factory(Account::class)->create();

        $this->assertCount(0, $award->accounts);

        $account->award($award);

        $this->assertCount(1, $award->fresh()->accounts);
    }
}
