<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hero;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $categories = Category::where('status', 1)->get();
        return view('frontend.home.index', compact('hero', 'categories'));
    }

    function listings(Request $request): View
    {

        $listing  = Listing::with(['category', 'location'])->where(['status' => 1, 'is_approved' => 1]);

        $listing->when($request->has('category'), function ($query)  use ($request) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('slug', $request->category);
            });
        });
        // dd($listings->get());
        $listings = $listing->paginate(12);
        return view('frontend.pages.listings', compact('listings'));
    }

    function listingModal($id)
    {
        $listing  = Listing::findOrFail($id);
        return view('frontend.layouts.ajax-listing-modal', compact('listing'))->render();
    }

    function showListing($slug): View
    {
        $listing  = Listing::where(['status' => 1, 'is_verified' => 1])->where('slug', $slug)->first();

        $similarListings = Listing::where('category_id', $listing->category_id)->where('id', '!=', $listing->id)->orderBy('id', 'DESC')->take(4)->get();

        return view('frontend.pages.listing-view', compact('listing','similarListings'));
    }
}
