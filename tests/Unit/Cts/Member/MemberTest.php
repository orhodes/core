<?php

namespace Tests\Unit\Cts\Sessions;

use App\Models\Cts\Member;
use App\Models\Mship\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\UnitTestCase;

class MemberTest extends UnitTestCase
{
    use DatabaseTransactions;

    /* @var Member */
    protected $subjectUnderTest;

    protected function setUp()
    {
        parent::setUp();

        $this->subjectUnderTest = resolve(Member::class);
    }

    /** @test */
    public function it_returns_a_cts_account_from_a_core_account()
    {
        $id = 1300001;
        $coreAccount = factory(Account::class)->create(['id' => $id]);
        factory(Member::class)->create(['cid' => $id]);

        $member = $this->subjectUnderTest->findByCoreAccount($coreAccount);

        $this->assertInstanceOf(Member::class, $member);
        $this->assertEquals($member->cid, $coreAccount->id);
    }
}
