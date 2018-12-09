<?php

namespace Tests\Feature\Community;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PirepTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_fires_an_event_when_a_pirep_is_passed()
    {
        $this->fail('Test must be implemented');
    }

    /** @test */
    public function it_issues_an_award_when_a_pirep_is_passed()
    {
        $this->fail('Test must be implemented');
    }
}
