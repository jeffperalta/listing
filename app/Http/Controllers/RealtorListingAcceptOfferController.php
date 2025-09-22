<?php

namespace App\Http\Controllers;

use App\Models\Offer;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);

        // Accept selected offer
        $offer->update([
            'accepted_at' => now()
        ]);

        // Update the listing to mark it as sold
        $listing->update([
            'sold_at' => now()
        ]);

        // Reject all other offers
        $listing->offers()->except($offer)->update([
            'rejected_at' => now()
        ]);

        return redirect()->back()
            ->with(
                'success', 
                'Offer #' . $offer->id . ' accepted, other offers rejected'
            );
    }
}
