<?php

namespace Tests\Feature\Community;

use App\Events\Smartcars\BidCompleted;
use App\Models\Community\Award;
use App\Models\NetworkData\Pilot;
use App\Models\Smartcars\Bid;
use App\Models\Smartcars\Flight;
use App\Models\Smartcars\FlightCriterion;
use App\Models\Smartcars\Pirep;
use App\Models\Smartcars\Posrep;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PirepTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_issues_an_award_when_a_pirep_is_passed()
    {
        // Setup flight with criteria
        $flight = factory(Flight::class)->create();
        factory(FlightCriterion::class)->create([
            'flight_id' => $flight->id,
        ]);

        // Setup award for flight
        $award = factory(Award::class)->create([
            'awardable_type' => 'App\Models\Smartcars\Flight',
            'awardable_id' => $flight->id,
        ]);

        // Setup bid, suitable posrep & submit flight
        $bid = factory(Bid::class)->create(['flight_id' => $flight->id]);
        $posrep = factory(Posrep::class)->create(['bid_id' => $bid->id]);
        factory(Pilot::class)->create([
            'account_id' => $bid->account->id,
            'connected_at' => $posrep->created_at->subMinutes(5),
            'disconnected_at' => $posrep->created_at->addMinutes(5),
            'minutes_online' => 10000000,
        ]);
        $pirep = factory(Pirep::class)->create(['bid_id' => $bid->id]);

        $this->assertCount(0, $bid->account->fresh()->awards);

        $bid->complete();

        $this->assertCount(1, $bid->account->fresh()->awards);
    }

    /** @test */
    public function it_fires_an_event_when_a_bid_is_completed()
    {
        Event::fake();

        $flight = factory(Flight::class)->create();
        $bid = factory(Bid::class)->create(['flight_id' => $flight->id]);
        $bid->complete();

        Event::assertDispatched(BidCompleted::class);
    }
}
