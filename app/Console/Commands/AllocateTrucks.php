<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RequestTruck;

class AllocateTrucks extends Command
{
    protected $signature = 'allocate:trucks';
    protected $description = 'Allocate trucks to the lowest bidder after the bidding time ends';

    public function handle()
    {
        $this->info('Starting truck allocation process...');

        $requestTrucks = RequestTruck::where('bidding_ends_at', '<=', now())
                                     ->where('status', 0) // Only allocate if the status is 0 (not yet allocated)
                                     ->get();

        if ($requestTrucks->isEmpty()) {
            $this->info('No truck requests are due for allocation.');
            return;
        }

        foreach ($requestTrucks as $requestTruck) {
            $this->allocateTruck($requestTruck);
        }

        $this->info('Truck allocation process completed.');
    }

    private function allocateTruck(RequestTruck $requestTruck)
    {
        // Find the lowest bid for this request
        $lowestBid = $requestTruck->bids()->orderBy('bid', 'asc')->first();

        if ($lowestBid) {
            // Update the request truck with the winning bid
            $requestTruck->winning_bid_id = $lowestBid->id;
            $requestTruck->status = 1; // Set status to 1 to indicate it's allocated
            $requestTruck->save();

            $this->info("Truck request ID {$requestTruck->id} allocated to bid ID {$lowestBid->id}.");
        } else {
            $this->info("No bids found for truck request ID {$requestTruck->id}.");
        }
    }
}

