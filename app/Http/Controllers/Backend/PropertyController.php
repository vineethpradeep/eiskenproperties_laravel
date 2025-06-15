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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\File;

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
        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 6, 'prefix' => 'EP-']);
        $file = $request->file('property_thumbnail');

        if ($file) {
            $path = 'thumbnail/' . Str::uuid() . '.' . $file->getClientOriginalExtension();

            $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
            $bucket = config('filesystems.disks.supabase.bucket');
            $uploadUrl = $baseUrl . '/storage/v1/object/' . trim($bucket, '/') . '/' . ltrim($path, '/');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('filesystems.disks.supabase.service_key'),
                'Content-Type' => $file->getMimeType(),
            ])->withBody(
                file_get_contents($file),
                $file->getMimeType()
            )->put($uploadUrl);
            $saveUrl = $response->successful()
                ? $baseUrl . '/storage/v1/object/public/' . trim($bucket, '/') . '/' . ltrim($path, '/')
                : null;
        } else {
            $saveUrl = null;
        }

        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_category' => $request->property_category,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'furnishing' => $request->furnishing,
            'deposit' => $request->deposit ?? 0,
            'rent' => $request->rent,
            'description' => $request->description,
            'bedrooms' => $request->bedrooms ?? 0,
            'bathrooms' => $request->bathrooms,
            'floors' => $request->floors ?? 0,
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
            'property_thumbnail' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        // Multi Image Upload
        $uploadedImages = [];

        if ($request->hasFile('multiple_image')) {
            foreach ($request->file('multiple_image') as $img) {
                $path = 'multi-image/' . Str::uuid() . '.' . $img->getClientOriginalExtension();

                $uploadUrl = rtrim(config('filesystems.disks.supabase.url'), '/') . '/storage/v1/object/' .
                    trim(config('filesystems.disks.supabase.bucket'), '/') . '/' . ltrim($path, '/');

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . config('filesystems.disks.supabase.service_key'),
                    'Content-Type' => $img->getMimeType(),
                ])->withBody(
                    file_get_contents($img),
                    $img->getMimeType()
                )->put($uploadUrl);

                if ($response->successful()) {
                    $uploadedImages[] = rtrim(config('filesystems.disks.supabase.url'), '/') . '/storage/v1/object/public/' .
                        trim(config('filesystems.disks.supabase.bucket'), '/') . '/' . ltrim($path, '/');
                }
            }
        }

        if (empty($uploadedImages)) {
            $uploadedImages = [null];
        }

        foreach ($uploadedImages as $imageUrl) {
            MultiImage::insert([
                'property_id' => $property_id,
                'image' => $imageUrl,
                'created_at' => now(),
            ]);
        }

        $notification = [
            'message' => 'Property Added Successfully',
            'alert-type' => 'success',
        ];


        return redirect()->route('all.property')->with($notification);
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
            'deposit' => $request->deposit ?? 0,
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
        $oldImageUrl = $request->old_property_thumbnail_image;

        $image = $request->file('property_thumbnail');
        $path = 'thumbnail/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

        $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');
        $bucket = config('filesystems.disks.supabase.bucket');
        $uploadUrl = $baseUrl . '/storage/v1/object/' . trim($bucket, '/') . '/' . ltrim($path, '/');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('filesystems.disks.supabase.service_key'),
            'Content-Type'  => $image->getMimeType(),
        ])->withBody(
            file_get_contents($image),
            $image->getMimeType()
        )->put($uploadUrl);

        if ($response->successful()) {
            // Delete old image from Supabase (optional but cleaner)
            if (!empty($oldImageUrl)) {
                $oldPath = ltrim(str_replace("/storage/v1/object/public/{$bucket}/", '', parse_url($oldImageUrl, PHP_URL_PATH)), '/');

                Http::withHeaders([
                    'Authorization' => 'Bearer ' . config('filesystems.disks.supabase.service_key'),
                    'Content-Type' => 'application/json',
                ])->delete($baseUrl . '/storage/v1/object/' . trim($bucket, '/') . '/' . $oldPath);
            }

            $save_url = $baseUrl . '/storage/v1/object/public/' . trim($bucket, '/') . '/' . ltrim($path, '/');

            Property::findOrFail($pro_id)->update([
                'property_thumbnail' => $save_url,
                'updated_at' => now(),
            ]);

            return redirect()->back()->with([
                'message' => 'Property Thumbnail Updated Successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Thumbnail upload failed',
            'alert-type' => 'error',
        ]);
    }


    public function UpdatePropertyMultiImage(Request $request)
    {
        $multiImages = $request->multiple_image;

        if (!is_array($multiImages)) {
            return back()->with('error', 'No images selected.');
        }

        foreach ($multiImages as $id => $image) {
            $existingImage = MultiImage::findOrFail($id);

            // Build and delete the old file from Supabase
            $oldImageUrl = $existingImage->image;
            $bucket = config('filesystems.disks.supabase.bucket');
            $baseUrl = rtrim(config('filesystems.disks.supabase.url'), '/');

            if (!empty($oldImageUrl)) {
                $oldPath = ltrim(str_replace("/storage/v1/object/public/{$bucket}/", '', parse_url($oldImageUrl, PHP_URL_PATH)), '/');

                Http::withHeaders([
                    'Authorization' => 'Bearer ' . config('filesystems.disks.supabase.service_key'),
                    'Content-Type' => 'application/json',
                ])->delete($baseUrl . '/storage/v1/object/' . trim($bucket, '/') . '/' . $oldPath);
            }

            // Upload the new image
            $path = 'multi-image/' . Str::uuid() . '.' . $image->getClientOriginalExtension();
            $uploadUrl = $baseUrl . '/storage/v1/object/' . trim($bucket, '/') . '/' . ltrim($path, '/');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('filesystems.disks.supabase.service_key'),
                'Content-Type' => $image->getMimeType(),
            ])->withBody(
                file_get_contents($image),
                $image->getMimeType()
            )->put($uploadUrl);

            if ($response->successful()) {
                $publicUrl = $baseUrl . '/storage/v1/object/public/' . trim($bucket, '/') . '/' . ltrim($path, '/');

                $existingImage->update([
                    'image' => $publicUrl,
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->back()->with([
            'message' => 'Property Multi-Image Updated Successfully',
            'alert-type' => 'success',
        ]);
    }


    public function PropertyMultiImageDelete($id)
    {
        $multiImage = MultiImage::findOrFail($id);

        // Extract file path relative to bucket
        $publicUrl = $multiImage->image;
        $urlParts = parse_url($publicUrl);
        $path = ltrim(str_replace('/storage/v1/object/public/' . config('filesystems.disks.supabase.bucket') . '/', '', $urlParts['path'] ?? ''), '/');

        // Send DELETE request to Supabase
        $deleteResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('filesystems.disks.supabase.service_key'),
            'Content-Type' => 'application/json',
        ])->delete(
            rtrim(config('filesystems.disks.supabase.url'), '/') . '/storage/v1/object/' .
                trim(config('filesystems.disks.supabase.bucket'), '/') . '/' . $path
        );

        // Delete from database regardless of Supabase success
        $multiImage->delete();

        $notification = [
            'message' => 'Property Multi-Image Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function StoreNewMultiImage(Request $request)
    {
        $image = $request->file('multiple_image');

        $path = 'multi-image/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

        $uploadUrl = rtrim(config('filesystems.disks.supabase.url'), '/') . '/storage/v1/object/' .
            trim(config('filesystems.disks.supabase.bucket'), '/') . '/' . ltrim($path, '/');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('filesystems.disks.supabase.service_key'),
            'Content-Type' => $image->getMimeType(),
        ])->withBody(
            file_get_contents($image),
            $image->getMimeType()
        )->put($uploadUrl);

        if ($response->successful()) {
            $publicUrl = rtrim(config('filesystems.disks.supabase.url'), '/') . '/storage/v1/object/public/' .
                trim(config('filesystems.disks.supabase.bucket'), '/') . '/' . ltrim($path, '/');

            MultiImage::insert([
                'property_id' => $request->new_multi_image,
                'image' => $publicUrl,
                'created_at' => now(),
            ]);
        }

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
