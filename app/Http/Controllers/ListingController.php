<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth')->except(['index', 'show']);
        //$this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 
            'baths', 'beds',
            'minArea', 'maxArea'
        ]);

         return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => 
                    Listing::mostRecent()
                        ->filter($filters)
                        ->withoutSold()
                        ->paginate(9)
                        ->withQueryString()
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $listing->load(['images']);

        $offer = !Auth::user() 
            ? null
            : $listing->offers()->byMe()->first();


        $this->authorize('view', $listing);
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer,
            ]
        );
    }


}
