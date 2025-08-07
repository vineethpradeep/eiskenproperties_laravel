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
use App\Models\PropertyType;

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
            ->where('status', 1)
            ->where('property_category', 'sales')
            ->whereBetween('price', [100000, 5000000]); // Corrected field

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
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('min_square_feet')) {
            $query->where('property_size', '>=', $request->min_square_feet);
        }

        if ($request->filled('max_square_feet')) {
            $query->where('property_size', '<=', $request->max_square_feet);
        }

        $properties = $query->get();

        return view('frontend.property.property_search', compact('properties', 'category'));
    }

    public function SearchRent(Request $request)
    {
        $category = 'rent';

        $query = Property::with('propertyType')
            ->where('status', 1)
            ->where('property_category', 'rent');

        // Price range filtering (defaults already set via slider in the form)
        if ($request->filled('min_price')) {
            $query->where('rent', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('rent', '<=', $request->max_price);
        }

        // Square feet range filter
        if ($request->filled('min_square_feet')) {
            $query->where('property_size', '>=', $request->min_square_feet);
        }

        if ($request->filled('max_square_feet')) {
            $query->where('property_size', '<=', $request->max_square_feet);
        }


        // Text search
        if ($request->filled('search')) {
            $query->where('property_name', 'like', '%' . $request->search . '%');
        }

        // Street
        if ($request->filled('street') && $request->street !== 'All Streets') {
            $query->where('street', 'like', '%' . $request->street . '%');
        }

        // Property type
        $validTypes = PropertyType::pluck('property_type_name')->toArray();

        if ($request->filled('property_type') && in_array($request->property_type, $validTypes)) {
            $query->whereHas('propertyType', function ($q) use ($request) {
                $q->where('property_type_name', $request->property_type);
            });
        }


        // Bedrooms
        if ($request->filled('bedrooms') && $request->bedrooms !== 'Any') {
            $query->where('bedrooms', $request->bedrooms);
        }

        // Bathrooms
        if ($request->filled('bathrooms') && $request->bathrooms !== 'Any') {
            $query->where('bathrooms', $request->bathrooms);
        }

        // Floors
        if ($request->filled('floors') && $request->floors !== 'Any') {
            $query->where('floors', $request->floors);
        }

        // Execute the query
        $properties = $query->get();

        return view('frontend.property.property_search', compact('properties', 'category'));
    }


    public function SearchAll(Request $request)
    {
        $category = 'all';

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
            $minPrice = (int) $request->min_price;
            $query->where(function ($q) use ($minPrice) {
                $q->where(function ($q1) use ($minPrice) {
                    $q1->where('property_category', 'rent')
                        ->where('rent', '>=', $minPrice);
                })->orWhere(function ($q2) use ($minPrice) {
                    $q2->where('property_category', 'sales')
                        ->where('price', '>=', $minPrice);
                });
            });
        }

        if ($request->filled('max_price')) {
            $maxPrice = (int) $request->max_price;
            $query->where(function ($q) use ($maxPrice) {
                $q->where(function ($q1) use ($maxPrice) {
                    $q1->where('property_category', 'rent')
                        ->where('rent', '<=', $maxPrice);
                })->orWhere(function ($q2) use ($maxPrice) {
                    $q2->where('property_category', 'sales')
                        ->where('price', '<=', $maxPrice);
                });
            });
        }


        // Square feet filters stay the same
        if ($request->filled('min_square_feet')) {
            $query->where('property_size', '>=', $request->min_square_feet);
        }

        if ($request->filled('max_square_feet')) {
            $query->where('property_size', '<=', $request->max_square_feet);
        }

        $properties = $query->get();

        return view('frontend.property.all_property_list', compact('properties'));
    }


    public function AllPropertyList()
    {
        $properties = Property::latest()->get();
        return view('frontend.property.all_property_list', compact('properties'));
    }
}
