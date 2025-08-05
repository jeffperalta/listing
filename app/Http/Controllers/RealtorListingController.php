<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{

    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;


    public function index(Request $request) {

        $keys = ['deleted', 'drafts'];
        $filters = [];
        foreach ($keys as $key) {
            $filters[$key] = $request->boolean($key);
        }
        $filters = array_merge(
            $filters,
            $request->only([
                'by', 'order'
            ])
        );


       return inertia('Realtor/Index', [
           'listings' => Auth::user()
                ->listings()
                ->filter($filters)
                ->paginate(6)
                ->withQueryString(),
           'filters' => $filters
        ]);
    }

/**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Listing::class);
        return inertia('Realtor/Create');
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

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was created!');
    }

    public function destroy(Listing $listing) {
        $this->authorize('delete', $listing);
        $listing->deleteOrFail();
        return redirect()
            ->back()
            ->with('success', 'Listing deleted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        $this->authorize('update', $listing);
        return inertia(
            'Realtor/Edit',
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
        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing was updated!');
    }
}
