<?php

namespace Tests\Feature\Community;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FlightTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_allows_an_award_to_be_issued_from_a_flight()
    {
        $this->fail('Test must be implemented');
    }
}
