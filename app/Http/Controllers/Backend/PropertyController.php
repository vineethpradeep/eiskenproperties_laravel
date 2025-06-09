<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Amenities;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyViewing;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduleConfirmedMail as ViewingSchedule;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mul;


class PropertyController extends Controller
{
    public function AllProperty()
    {
        $properties = Property::latest()->get();
        return view('backend.property.all_property', compact('properties'));
    }

    public function AddProperty()
    {
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgents = User::where('role', 'agent')->where('status', 'active')->latest()->get();
        return view('backend.property.add_property', compact('propertyType', 'amenities', 'activeAgents'));
    }

    public function StoreProperty(Request $request)
    {

        $amenitiesId = $request->amenities_id;
        $amenities = implode(',', $amenitiesId);
        // dd($amenities);

        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 6, 'prefix' => 'EP-']);


        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::read($image)->resize(408, 272)->save(public_path('upload/property/thumbnail/' . $name_gen));
        $save_url = 'upload/property/thumbnail/' . $name_gen;

        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_category' => $request->property_category,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'furnishing' => $request->furnishing,
            'deposit' => $request->deposit,
            'rent' => $request->rent,
            'description' => $request->description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'floors' => $request->floors,
            'condition' => $request->condition,
            'epc' => $request->epc,
            'availabilityDate' => $request->availabilityDate,
            'council_band' => $request->council_band,
            'property_size' => $request->property_size,
            'property_year' => $request->property_year,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'school_distance' => $request->school_distance,
            'bus_distance' => $request->bus_distance,
            'station_distance' => $request->station_distance,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'status' => 1,
            'agent_id' => $request->agent_id,
            'property_thumbnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        // Multi Image Upload
        $images = $request->file('multiple_image');
        foreach ($images as $img) {
            $multi_name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::read($img)->resize(408, 272)->save('upload/property/multi-image/' . $multi_name_gen);
            $multi_save_url = 'upload/property/multi-image/' . $multi_name_gen;

            MultiImage::insert([
                'property_id' => $property_id,
                'image' => $multi_save_url,
                'created_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('all.property')->with('success', 'Property Added Successfully');
    }

    public function EditProperty($id)
    {
        $property = Property::findOrFail($id);

        $amenitieTags = $property->amenities_id;
        $amenities_type = explode(',', $amenitieTags);
        $multiImage = MultiImage::where('property_id', $id)->get();

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgents = User::where('role', 'agent')->where('status', 'active')->latest()->get();

        $notification = [
            'message' => 'Property Added Successfully',
            'alert-type' => 'success',
        ];


        return view('backend.property.edit_property', compact('property', 'propertyType', 'amenities', 'activeAgents', 'amenities_type', 'multiImage'));
    }

    public function UpdateProperty(Request $request)
    {
        $amenitiesId = $request->amenities_id;
        $amenities = implode(',', $amenitiesId);

        $property_id = $request->id;
        Property::findOrFail($property_id)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_category' => $request->property_category,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,
            'furnishing' => $request->furnishing,
            'deposit' => $request->deposit,
            'rent' => $request->rent,
            'description' => $request->description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'floors' => $request->floors,
            'condition' => $request->condition,
            'epc' => $request->epc,
            'availabilityDate' => $request->availabilityDate,
            'council_band' => $request->council_band,
            'property_size' => $request->property_size,
            'property_year' => $request->property_year,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'school_distance' => $request->school_distance,
            'bus_distance' => $request->bus_distance,
            'station_distance' => $request->station_distance,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.property')->with($notification);
    }

    public function UpdatePropertyThumbnail(Request $request)
    {
        $request->validate([
            'property_thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120' // Max 5MB
        ]);

        $pro_id = $request->id;
        $oldImage = $request->old_property_thumbnail_image;

        $image = $request->file('property_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::read($image)->resize(408, 272)->save(public_path('upload/property/thumbnail/' . $name_gen));
        $save_url = 'upload/property/thumbnail/' . $name_gen;

        if (file_exists($oldImage)) {
            @unlink($oldImage);
        }

        Property::findOrFail($pro_id)->update([
            'property_thumbnail' => $save_url,
            'updated_at' => now(),
        ]);

        $notification = [
            'message' => 'Property Thumbnail Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function UpdatePropertyMultiImage(Request $request)
    {
        $multiImages = $request->multiple_image; // This is now an associative array with image_id as key

        if (!is_array($multiImages)) {
            return back()->with('error', 'No images selected.');
        }

        foreach ($multiImages as $id => $image) {
            $existingImage = MultiImage::findOrFail($id);

            // Delete old image file
            if (file_exists(public_path($existingImage->image))) {
                unlink(public_path($existingImage->image));
            }

            // Save new image
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::read($image)->resize(408, 272)->save(public_path('upload/property/multi-image/' . $name_gen));
            $save_url = 'upload/property/multi-image/' . $name_gen;

            // Update DB
            $existingImage->update([
                'image' => $save_url,
                'updated_at' => now(),
            ]);
        }

        $notification = [
            'message' => 'Property Multi-Image Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function PropertyMultiImageDelete($id)
    {
        $multiImage = MultiImage::findOrFail($id);
        if (file_exists(public_path($multiImage->image))) {
            unlink(public_path($multiImage->image));
        }
        $multiImage->delete();

        $notification = [
            'message' => 'Property Multi-Image Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function StoreNewMultiImage(Request $request)
    {
        $newMultiImageId = $request->new_multi_image;

        if (!$request->hasFile('multiple_image')) {
            return back()->with('error', 'No image file uploaded.');
        }

        $image = $request->file('multiple_image');

        if (!$image->isValid()) {
            return back()->with('error', 'Uploaded image is not valid.');
        }

        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::read($image)->resize(408, 272)->save(public_path('upload/property/multi-image/' . $name_gen));
        $save_url = 'upload/property/multi-image/' . $name_gen;

        MultiImage::insert([
            'property_id' => $newMultiImageId,
            'image' => $save_url,
            'created_at' => now(),
        ]);

        $notification = [
            'message' => 'Property Multi-Image Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function DeleteProperty($id)
    {
        $property = Property::findOrFail($id);
        unlink($property->property_thumbnail);

        Property::findOrFail($id)->delete();

        $image = MultiImage::where('property_id', $id)->get();
        foreach ($image as $img) {
            unlink($img->image);
            MultiImage::where('property_id', $id)->delete();
        }

        $notification = [
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function DetailsProperty($id)
    {
        $property = Property::findOrFail($id);
        $propertyType = $property->amenities_id;
        $multiImage = MultiImage::where('property_id', $id)->get();
        $amenities = Amenities::latest()->get();
        $amenitieTags = $property->amenities_id;
        $amenities_type = explode(',', $amenitieTags);
        $activeAgents = User::where('role', 'agent')->where('status', 'active')->latest()->get();
        return view('backend.property.details_property', compact('property', 'propertyType', 'amenities', 'activeAgents', 'multiImage', 'amenities_type'));
    }

    public function ToggleStatus(Request $request)
    {
        $property = Property::findOrFail($request->property_id);
        $property->status = $request->status; // 1 or 0
        $property->save();

        $notification = [
            'message' => 'Status Updated Successfully',
            'alert-type' => 'success',
        ];

        return back()->with($notification);
    }

    public function ScheduleViewing(Request $request)
    {
        $viewTime12Hr = $request->view_time;
        $viewTime24Hr = date("H:i:s", strtotime($viewTime12Hr));
        // Validate request
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'view_date' => 'required|date',
            'view_time' => 'required',
            'view_name' => 'required|string|max:255',
            'view_email' => 'required|email',
        ]);

        PropertyViewing::create([
            'property_id' => $request->property_id,
            'user_id' => Auth::id() ?? null, // Set user_id to null if not authenticated
            'name' => $request->view_name,
            'email' => $request->view_email,
            'phone' => $request->view_phone,
            'view_date' => $request->view_date,
            'view_time' => $viewTime24Hr,
            'message' => $request->view_message,
        ]);

        $notification = [
            'message' => 'Viewing Scheduled Successfully',
            'alert-type' => 'success',
        ];

        return back()->with($notification);
    }

    public function ScheduleRequest()
    {
        $requestView = PropertyViewing::with('property', 'user')->latest()->get();
        return view('backend.property.schedule_request', compact('requestView'));
    }

    public function ViewSchedule($id)
    {
        $schedule = PropertyViewing::with('property', 'user')->findOrFail($id);
        return view('backend.property.view_schedule', compact('schedule'));
    }

    public function UpdateSchedule(Request $request)
    {
        $scheduleId = $request->id;
        PropertyViewing::findOrFail($scheduleId)->update([
            'status' => '1', // Assuming 1 means confirmed
            'updated_at' => Carbon::now(),
        ]);

        // Send Email
        $sendMail = PropertyViewing::findOrFail($scheduleId);
        $data = [
            'name' => $sendMail->name,
            'view_date' => $sendMail->view_date,
            'view_time' => $sendMail->view_time,
            'property_address' => $sendMail->property->address,
        ];

        Mail::to($sendMail->email)->send(new ViewingSchedule($data));

        $notification = [
            'message' => 'Viewing Request Confirmed Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('schedule.request')->with($notification);
    }

    public function DeleteSchedule($id)
    {
        PropertyViewing::findOrFail($id)->delete();
        $notification = [
            'message' => 'Viewing Request Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
