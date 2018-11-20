<?php

namespace Tests\Unit\Cts\Sessions;

use App\Models\Cts\Member;
use App\Models\Mship\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\UnitTestCase;
use App\Repositories\Cts\SessionRepository;
use App\Models\Cts\Session;

class SessionRepositoryTest extends UnitTestCase
{
    use DatabaseTransactions;

    /* @var SessionRepository */
    protected $subjectUnderTest;

    protected function setUp()
    {
        parent::setUp();

        $this->subjectUnderTest = resolve(SessionRepository::class);
    }

    /** @test */
    public function it_returns_sessions_for_a_mentor_id()
    {
        $mentor = factory(Account::class)->create(['id' => 1258635]);
        $mentorCts = factory(Member::class)->create(['cid' => 1258635]);
        $session = factory(Session::class)->create(['mentor_id' => $mentor->id]);

        $sessions = $this->subjectUnderTest->byMentor($mentor);

        $this->assertContains($session->position, $sessions);
        $this->assertContains($session->mentor, $sessions);
    }
}
