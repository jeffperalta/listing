<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{

    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;


    public function index() {
       return inertia('Realtor/Index', [
           'listings' => Auth::user()->listings()->get(),
       ]);
    }

    public function destroy(Listing $listing) {
        $this->authorize('delete', $listing);
        $listing->deleteOrFail();
        return redirect()->back()->with('success', 'Listing deleted successfully.');
    }
}
