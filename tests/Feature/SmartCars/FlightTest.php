<?php

namespace Tests\Feature\Community;

use App\Models\Community\Award;
use App\Models\Smartcars\Flight;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FlightTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_attributes_an_award_to_a_flight()
    {
        $flight = factory(Flight::class)->create();

        $award = factory(Award::class)->create([
            'awardable_type' => 'App\Models\Smartcars\Flight',
            'awardable_id' => $flight->id,
        ]);

        $this->assertEquals($flight->award->get(), $award->get());
    }
}
