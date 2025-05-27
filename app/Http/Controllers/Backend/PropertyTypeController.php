<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\Amenities;
use PhpParser\Builder\Property;

class PropertyTypeController extends Controller
{
    public function AllPropertyType()
    {
        $types = PropertyType::latest()->get();
        return view('backend.property_type.all_property_type', compact('types'));
    }

    public function AddPropertyType()
    {
        return view('backend.property_type.add_property_type');
    }

    public function StorePropertyType(Request $request)
    {
        $request->validate([
            'property_type_name' => 'required',
            'property_icon' => 'required',
        ]);

        PropertyType::insert([
            'property_type_name' => $request->property_type_name,
            'property_icon' => $request->property_icon,
        ]);

        $notification = [
            'message' => 'Property Type Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.property_type')->with($notification);
    }

    public function EditPropertyType($id)
    {
        $type = PropertyType::findOrFail($id);
        return view('backend.property_type.edit_property_type', compact('type'));
    }

    public function UpdatePropertyType(Request $request)
    {
        $request->validate([
            'property_type_name' => 'required',
            'property_icon' => 'required',
        ]);

        PropertyType::findOrFail($request->id)->update([
            'property_type_name' => $request->property_type_name,
            'property_icon' => $request->property_icon,
        ]);

        $notification = [
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.property_type')->with($notification);
    }

    public function DeletePropertyType($id)
    {
        PropertyType::findOrFail($id)->delete();
        $notification = [
            'message' => 'Property Type Deleted Successfully',
            'alert-type' => 'info',
        ];
        return redirect()->back()->with($notification);
    }

    public function AllAmenitie()
    {
        $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenitie', compact('amenities'));
    }

    public function AddAmenitie()
    {
        return view('backend.amenities.add_amenitie');
    }

    public function StoreAmenitie(Request $request)
    {
        $request->validate([
            'amenitie_name' => 'required',
        ]);

        Amenities::insert([
            'amenitie_name' => $request->amenitie_name,
        ]);

        $notification = [
            'message' => 'Property Amenitie Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.amenitie')->with($notification);
    }

    public function EditAmenitie($id)
    {
        $amenitie = Amenities::findOrFail($id);
        return view('backend.amenities.edit_amenitie', compact('amenitie'));
    }

    public function UpdateAmenitie(Request $request)
    {
        $request->validate([
            'amenitie_name' => 'required',
        ]);

        Amenities::findOrFail($request->id)->update([
            'amenitie_name' => $request->amenitie_name,
        ]);

        $notification = [
            'message' => 'Property Amenitie Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.amenitie')->with($notification);
    }

    public function DeleteAmenitie($id)
    {
        Amenities::findOrFail($id)->delete();
        $notification = [
            'message' => 'Property Amenitie Deleted Successfully',
            'alert-type' => 'info',
        ];
        return redirect()->back()->with($notification);
    }
}
