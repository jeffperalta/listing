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
                ->get(),
           'filters' => $filters
        ]);
    }

    public function destroy(Listing $listing) {
        $this->authorize('delete', $listing);
        $listing->deleteOrFail();
        return redirect()
            ->back()
            ->with('success', 'Listing deleted successfully.');
    }
}
