<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load('images');
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing, Request $request) 
    {
        if($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ],[
                'images.*.image' => 'The file must be an image.',
                'images.*.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'images.*.max' => 'The image must not be greater than 2MB.',
            ]);
            
            foreach($request->file('images') as $file) {
                $path = $file->store('images', 'public');
                $listing->images()->save(new ListingImage([
                    'filename'=> $path
                ]));
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Listing image uploaded successfully.');
    }

    public function destroy($listing, ListingImage $image) {
        Storage::disk('public')->delete($image->filename);
        $image->delete();
        return redirect()
            ->back()
            ->with('success', 'Listing image deleted successfully.');
    }
}
