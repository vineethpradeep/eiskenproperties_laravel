<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MultiImage;
use App\Models\Amenities;
use App\Models\Feature;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function PropertyDetails($id, $slug)
    {
        $property = Property::FindOrFail($id);
        $multiImage = MultiImage::where('property_id', $id)->get();
        // Amenities check
        $propertyAmenities = collect();
        if (!empty($property->amenities_id)) {
            $amenities = explode(',', $property->amenities_id);
            if (!empty($amenities)) {
                $propertyAmenities = Amenities::whereIn('id', $amenities)->get();
            }
        }

        // Features check
        $propertyFeatures = collect();
        if (!empty($property->features_id)) {
            $features = explode(',', $property->features_id);
            if (!empty($features)) {
                $propertyFeatures = Feature::whereIn('id', $features)->get();
            }
        }
        $propertyTypeId = $property->ptype_id;
        $similarProperty = Property::where('ptype_id', $propertyTypeId)
            ->where('id', '!=', $id)
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();

        $userWishlist = Wishlist::where('user_id', Auth::id())
            ->pluck('property_id')
            ->toArray();
        $streets = Property::whereNotNull('street')
            ->where('street', '!=', '')
            ->distinct()
            ->pluck('street')
            ->values();
        return view('frontend.property.property_details', compact(
            'property',
            'multiImage',
            'propertyAmenities',
            'propertyFeatures',
            'similarProperty',
            'userWishlist',
            'streets'
        ));
    }

    public function SearchSale(Request $request)
    {
        $category = 'sales';
        $query = Property::with('propertyType')
            ->where('property_category', 'sales')
            ->whereBetween('rent', [100000, 5000000]);

        if ($request->filled('search')) {
            $query->where('property_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('street') && $request->street !== 'All Streets') {
            $query->where('street', 'like', '%' . $request->street . '%');
        }

        if ($request->filled('property_type') && $request->property_type !== 'Any Type') {
            $query->whereHas('propertyType', function ($q) use ($request) {
                $q->where('property_type_name', $request->property_type);
            });
        }

        if ($request->filled('bedrooms') && $request->bedrooms !== 'Any') {
            $query->where('bedrooms', $request->bedrooms);
        }

        if ($request->filled('bathrooms') && $request->bathrooms !== 'Any') {
            $query->where('bathrooms', $request->bathrooms);
        }

        if ($request->filled('floors') && $request->floors !== 'Any') {
            $query->where('floors', $request->floors);
        }

        if ($request->filled('min_price')) {
            $query->where('rent', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('rent', '<=', $request->max_price);
        }

        // if ($request->filled('min_square_feet')) {
        //     $query->where('property_size', '>=', $request->min_square_feet);
        // }
        // if ($request->filled('max_square_feet')) {
        //     $query->where('property_size', '<=', $request->max_square_feet);
        // }

        $properties = $query->get();

        return view('frontend.property.property_search', compact('properties', 'category'));
    }

    public function SearchRent(Request $request)
    {
        $category = 'rent';
        $query = Property::with('propertyType')
            ->where('status', 1)
            ->where('property_category', 'rent')
            ->whereBetween('rent', [200, 10000]);

        if ($request->filled('search')) {
            $query->where('property_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('street') && $request->street !== 'All Streets') {
            $query->where('street', 'like', '%' . $request->street . '%');
        }

        if ($request->filled('property_type') && $request->property_type !== 'Any Type') {
            $query->whereHas('propertyType', function ($q) use ($request) {
                $q->where('property_type_name', $request->property_type);
            });
        }

        if ($request->filled('bedrooms') && $request->bedrooms !== 'Any') {
            $query->where('bedrooms', $request->bedrooms);
        }

        if ($request->filled('bathrooms') && $request->bathrooms !== 'Any') {
            $query->where('bathrooms', $request->bathrooms);
        }

        if ($request->filled('floors') && $request->floors !== 'Any') {
            $query->where('floors', $request->floors);
        }

        if ($request->filled('min_price')) {
            $query->where('rent', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('rent', '<=', $request->max_price);
        }

        // if ($request->filled('min_square_feet')) {
        //     $query->where('property_size', '>=', $request->min_square_feet);
        // }
        // if ($request->filled('max_square_feet')) {
        //     $query->where('property_size', '<=', $request->max_square_feet);
        // }

        $properties = $query->get();

        return view('frontend.property.property_search', compact('properties', 'category'));
    }

    public function SearchAll(Request $request)
    {
        $query = Property::with('propertyType');

        if ($request->filled('search')) {
            $query->where('property_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('street') && $request->street !== 'All Streets') {
            $query->where('street', 'like', '%' . $request->street . '%');
        }

        if ($request->filled('property_type') && $request->property_type !== 'Any Type') {
            $query->whereHas('propertyType', function ($q) use ($request) {
                $q->where('property_type_name', $request->property_type);
            });
        }

        if ($request->filled('bedrooms') && $request->bedrooms !== 'Any') {
            $query->where('bedrooms', $request->bedrooms);
        }

        if ($request->filled('bathrooms') && $request->bathrooms !== 'Any') {
            $query->where('bathrooms', $request->bathrooms);
        }

        if ($request->filled('floors') && $request->floors !== 'Any') {
            $query->where('floors', $request->floors);
        }

        if ($request->filled('min_price')) {
            $query->where('rent', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('rent', '<=', $request->max_price);
        }

        // if ($request->filled('min_square_feet')) {
        //     $query->where('property_size', '>=', $request->min_square_feet);
        // }
        // if ($request->filled('max_square_feet')) {
        //     $query->where('property_size', '<=', $request->max_square_feet);
        // }

        $properties = $query->get();

        return view('frontend.property.all_property_list', compact('properties'));
    }

    public function AllPropertyList()
    {
        $properties = Property::latest()->get();
        return view('frontend.property.all_property_list', compact('properties'));
    }
}
