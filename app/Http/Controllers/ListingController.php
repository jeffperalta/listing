<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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
         return inertia(
            'Listing/Index',
            [
                'filters' => $request->only([
                    'priceFrom', 'priceTo', 
                    'baths', 'beds',
                    'minArea', 'maxArea'
                ]),
                'listings' => Listing::orderBy('created_at', 'desc')
                    ->paginate(9)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Listing::class);
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $listing = Listing::make(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        $listing->owner()->associate(Auth::user());
        $listing->save();

        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {

        $this->authorize('view', $listing);
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        $this->authorize('update', $listing);
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Listing was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);
        $listing->delete();
        return redirect()->back()
                    ->with('success', 'Listing was deleted!');
    }
}
