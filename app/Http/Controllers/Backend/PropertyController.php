<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Amenities;
use App\Models\Feature;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\PropertyViewing;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\JpegEncoder;
// use Intervention\Image\Facades\Image;
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
        $features = Feature::latest()->get();
        $activeAgents = User::where('role', 'agent')->where('status', 'active')->latest()->get();
        return view('backend.property.add_property', compact('propertyType', 'amenities', 'features', 'activeAgents'));
    }

    public function StoreProperty(Request $request)
    {
        // Handle optional multi-select inputs
        $amenitiesId = $request->input('amenities_id', []);
        $featuresId = $request->input('features_id', []);

        $amenities = implode(',', (array) $amenitiesId);
        $features = implode(',', (array) $featuresId);

        $pcode = IdGenerator::generate([
            'table' => 'properties',
            'field' => 'property_code',
            'length' => 6,
            'prefix' => 'EP-'
        ]);

        $file = $request->file('property_thumbnail');
        $saveUrl = null;

        try {
            if (!$file) {
                return response()->json(['error' => 'No image uploaded'], 400);
            }

            $image = Image::read($file)
                ->resize(1600, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode(new JpegEncoder(75));

            $path = 'thumbnail/' . Str::uuid() . '.jpg';

            $saved = Storage::disk('digitalocean')->put($path, (string) $image, [
                'visibility' => 'public',
                'ContentType' => 'image/jpeg',
            ]);

            if ($saved) {
                $saveUrl = Storage::disk('digitalocean')->url($path);
                return response()->json(['url' => $saveUrl], 200);
            } else {
                \Log::error('Thumbnail upload failed: Storage returned false');
                return response()->json(['error' => 'Upload failed'], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Thumbnail upload exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['error' => 'Upload failed: ' . $e->getMessage()], 500);
        }


        // if ($file) {
        //     // Create a medium resolution image (max 1600x1200)
        //     $image = Image::read($file) // <- use read() instead of make()
        //         ->resize(1600, 1200, function ($constraint) {
        //             $constraint->aspectRatio();
        //             $constraint->upsize();
        //         })
        //         ->encode(new JpegEncoder(75)); // quality 75%

        //     $path = 'thumbnail/' . Str::uuid() . '.jpg';

        //     $saved = Storage::disk('digitalocean')->put($path, (string) $image, [
        //         'visibility' => 'public',
        //         'ContentType' => 'image/jpeg',
        //     ]);

        //     if ($saved) {
        //         $saveUrl = Storage::disk('digitalocean')->url($path);
        //     }
        // }


        $propertyData = [
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'features_id' => $features,
            'property_name' => $request->property_name,
            'property_category' => $request->property_category,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,
            'furnishing' => $request->furnishing,
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
            'created_at' => now(),
        ];

        // Add price or rent/deposit based on category
        if ($request->property_category === 'rent') {
            $propertyData['rent'] = $request->rent ?? 0;
            $propertyData['deposit'] = $request->deposit ?? 0;
        } elseif ($request->property_category === 'sales') {
            $propertyData['price'] = $request->price ?? 0;
        }

        // Save property and get its ID
        $property_id = Property::insertGetId($propertyData);

        // Handle multiple image uploads
        $uploadedImages = [];

        if ($request->hasFile('multiple_image')) {
            foreach ($request->file('multiple_image') as $img) {
                try {
                    $image = Image::read($img) // use read() instead of make()
                        ->resize(1600, 1200, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode(new JpegEncoder(75)); // JPEG encoder with quality 75

                    $path = 'multi-image/' . Str::uuid() . '.jpg';
                    $saved = Storage::disk('digitalocean')->put($path, (string) $image, [
                        'visibility' => 'public',
                        'ContentType' => 'image/jpeg',
                    ]);

                    if ($saved) {
                        $uploadedImages[] = Storage::disk('digitalocean')->url($path);
                    }
                } catch (\Exception $e) {
                    \Log::error('Failed to upload image: ' . $e->getMessage());
                }
            }
        }


        // Save image records to DB
        foreach ($uploadedImages as $imageUrl) {
            MultiImage::create([
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

        // Handle null or empty amenities_id safely
        $amenitieTags = $property->amenities_id ?? '';
        $amenities_type = !empty($amenitieTags) ? explode(',', $amenitieTags) : [];

        $multiImage = MultiImage::where('property_id', $id)->get();

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $features = Feature::latest()->get();
        $activeAgents = User::where('role', 'agent')->where('status', 'active')->latest()->get();

        // $featureTags = $property->features_id ?? '';
        // $features_type = !empty($featureTags) ? explode(',', $featureTags) : [];

        return view('backend.property.edit_property', compact(
            'property',
            'propertyType',
            'amenities',
            'features',
            'activeAgents',
            'amenities_type',
            'multiImage'
        ));
    }


    public function UpdateProperty(Request $request)
    {
        // Gracefully handle missing or null checkbox/multi-select inputs
        $amenitiesId = $request->input('amenities_id', []);
        $featuresId = $request->input('features_id', []);

        $amenities = implode(',', (array) $amenitiesId);
        $features = implode(',', (array) $featuresId);

        $property_id = $request->id;

        Property::findOrFail($property_id)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'features_id' => $features,
            'property_name' => $request->property_name,
            'property_category' => $request->property_category,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,
            'furnishing' => $request->furnishing,
            'deposit' => $request->deposit ?? 0,
            'rent' => $request->rent ?? 0,
            'price' => $request->price ?? 0,
            'description' => $request->description,
            'bedrooms' => $request->bedrooms ?? 0,
            'bathrooms' => $request->bathrooms ?? 0,
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
            'agent_id' => $request->agent_id,
            'updated_at' => now(),
        ]);

        $notification = [
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.property')->with($notification);
    }


    // public function UpdatePropertyThumbnail(Request $request)
    // {
    //     $request->validate([
    //         'property_thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120' // Max 5MB
    //     ]);

    //     $pro_id = $request->id;
    //     $oldImageUrl = $request->old_property_thumbnail_image;

    //     $image = $request->file('property_thumbnail');
    //     $path = 'thumbnail/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

    //     try {
    //         // Upload to DigitalOcean Spaces
    //         Storage::disk('digitalocean')->put($path, file_get_contents($image), 'public');

    //         // Delete old image if it exists
    //         if (!empty($oldImageUrl)) {
    //             $oldPath = ltrim(parse_url($oldImageUrl, PHP_URL_PATH), '/');
    //             // Remove bucket name and domain to get relative key
    //             $relativePath = preg_replace("/^" . preg_quote(env('DO_BUCKET')) . "\//", '', $oldPath);
    //             Storage::disk('digitalocean')->delete($relativePath);
    //         }

    //         // Generate public URL
    //         $saveUrl = Storage::disk('digitalocean')->url($path);

    //         Property::findOrFail($pro_id)->update([
    //             'property_thumbnail' => $saveUrl,
    //             'updated_at' => now(),
    //         ]);

    //         return redirect()->back()->with([
    //             'message' => 'Property Thumbnail Updated Successfully',
    //             'alert-type' => 'success',
    //         ]);
    //     } catch (\Exception $e) {
    //         \Log::error('Failed to upload thumbnail: ' . $e->getMessage());

    //         return redirect()->back()->with([
    //             'message' => 'Thumbnail upload failed',
    //             'alert-type' => 'error',
    //         ]);
    //     }
    // }

    public function UpdatePropertyThumbnail(Request $request)
    {
        $request->validate([
            'property_thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120' // Max 5MB
        ]);

        $pro_id = $request->id;
        $oldImageUrl = $request->old_property_thumbnail_image;

        $file = $request->file('property_thumbnail');
        $extension = strtolower($file->getClientOriginalExtension());
        $path = 'thumbnail/' . Str::uuid() . '.jpg'; // force jpg for compression

        try {
            // Resize + compress with Intervention
            $image = Image::read($file)
                ->resize(1600, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode(new JpegEncoder(75)); // compress as jpg

            // Upload to DigitalOcean Spaces
            Storage::disk('digitalocean')->put($path, (string) $image, [
                'visibility' => 'public',
                'ContentType' => 'image/jpeg',
            ]);

            // Delete old image if it exists
            if (!empty($oldImageUrl)) {
                $oldPath = ltrim(parse_url($oldImageUrl, PHP_URL_PATH), '/');
                $relativePath = preg_replace(
                    "/^" . preg_quote(env('DO_BUCKET')) . "\//",
                    '',
                    $oldPath
                );
                Storage::disk('digitalocean')->delete($relativePath);
            }

            // Generate public URL
            $saveUrl = Storage::disk('digitalocean')->url($path);

            Property::findOrFail($pro_id)->update([
                'property_thumbnail' => $saveUrl,
                'updated_at' => now(),
            ]);

            return redirect()->back()->with([
                'message' => 'Property Thumbnail Updated Successfully',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to upload thumbnail: ' . $e->getMessage());

            return redirect()->back()->with([
                'message' => 'Thumbnail upload failed',
                'alert-type' => 'error',
            ]);
        }
    }

    // public function UpdatePropertyMultiImage(Request $request)
    // {
    //     $multiImages = $request->multiple_image;

    //     if (!is_array($multiImages)) {
    //         return back()->with('error', 'No images selected.');
    //     }

    //     foreach ($multiImages as $id => $image) {
    //         $existingImage = MultiImage::findOrFail($id);

    //         // Get the old image path and delete it from Spaces
    //         $oldImageUrl = $existingImage->image;
    //         if (!empty($oldImageUrl)) {
    //             $parsedPath = parse_url($oldImageUrl, PHP_URL_PATH);
    //             $bucket = config('filesystems.disks.digitalocean.bucket');
    //             $relativeKey = preg_replace("/^\/?{$bucket}\//", '', ltrim($parsedPath, '/'));

    //             Storage::disk('digitalocean')->delete($relativeKey);
    //         }

    //         // Upload the new image
    //         $path = 'multi-image/' . Str::uuid() . '.' . $image->getClientOriginalExtension();
    //         $uploaded = Storage::disk('digitalocean')->put($path, file_get_contents($image), 'public');

    //         if ($uploaded) {
    //             $publicUrl = Storage::disk('digitalocean')->url($path);

    //             $existingImage->update([
    //                 'image' => $publicUrl,
    //                 'updated_at' => now(),
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with([
    //         'message' => 'Property Multi-Image Updated Successfully',
    //         'alert-type' => 'success',
    //     ]);
    // }

    public function UpdatePropertyMultiImage(Request $request)
    {
        $multiImages = $request->multiple_image;

        if (!is_array($multiImages)) {
            return back()->with('error', 'No images selected.');
        }

        foreach ($multiImages as $id => $image) {
            $existingImage = MultiImage::findOrFail($id);

            // Delete old image from DigitalOcean Spaces
            $oldImageUrl = $existingImage->image;
            if (!empty($oldImageUrl)) {
                $parsedPath = parse_url($oldImageUrl, PHP_URL_PATH);
                $bucket = config('filesystems.disks.digitalocean.bucket');
                $relativeKey = preg_replace("/^\/?{$bucket}\//", '', ltrim($parsedPath, '/'));

                Storage::disk('digitalocean')->delete($relativeKey);
            }

            // Define new path (force jpg for compression)
            $path = 'multi-image/' . Str::uuid() . '.jpg';

            try {
                // Resize + compress using Intervention
                $processedImage = Image::read($image)
                    ->resize(1600, 1200, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode(new JpegEncoder(75));

                // Upload processed image
                $uploaded = Storage::disk('digitalocean')->put($path, (string) $processedImage, [
                    'visibility' => 'public',
                    'ContentType' => 'image/jpeg',
                ]);

                if ($uploaded) {
                    $publicUrl = Storage::disk('digitalocean')->url($path);

                    $existingImage->update([
                        'image' => $publicUrl,
                        'updated_at' => now(),
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error("Failed to upload multi-image ID {$id}: " . $e->getMessage());
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

        $publicUrl = $multiImage->image;

        // Parse the URL to extract the relative path
        $parsedPath = parse_url($publicUrl, PHP_URL_PATH);
        $bucket = config('filesystems.disks.digitalocean.bucket');

        // Remove bucket prefix if present
        $relativeKey = preg_replace("/^\/?{$bucket}\//", '', ltrim($parsedPath, '/'));

        // Delete the image from DigitalOcean Spaces
        if (!empty($relativeKey)) {
            Storage::disk('digitalocean')->delete($relativeKey);
        }

        // Remove the DB record regardless of storage outcome
        $multiImage->delete();

        return redirect()->back()->with([
            'message' => 'Property Multi-Image Deleted Successfully',
            'alert-type' => 'success',
        ]);
    }

    // public function StoreNewMultiImage(Request $request)
    // {
    //     $image = $request->file('multiple_image');

    //     if (!$image) {
    //         return redirect()->back()->with([
    //             'message' => 'No image uploaded',
    //             'alert-type' => 'error',
    //         ]);
    //     }

    //     // Generate unique storage path
    //     $path = 'multi-image/' . Str::uuid() . '.' . $image->getClientOriginalExtension();

    //     try {
    //         // Upload to DigitalOcean Spaces
    //         Storage::disk('digitalocean')->put($path, file_get_contents($image), [
    //             'visibility' => 'public',
    //             'ContentType' => $image->getMimeType(),
    //         ]);


    //         // Generate public URL
    //         $publicUrl = Storage::disk('digitalocean')->url($path);

    //         // Save record in DB
    //         MultiImage::insert([
    //             'property_id' => $request->new_multi_image,
    //             'image' => $publicUrl,
    //             'created_at' => now(),
    //         ]);

    //         return redirect()->back()->with([
    //             'message' => 'Property Multi-Image Added Successfully',
    //             'alert-type' => 'success',
    //         ]);
    //     } catch (\Exception $e) {
    //         \Log::error('Multi-image upload failed: ' . $e->getMessage());

    //         return redirect()->back()->with([
    //             'message' => 'Image upload failed',
    //             'alert-type' => 'error',
    //         ]);
    //     }
    // }

    public function StoreNewMultiImage(Request $request)
    {
        $image = $request->file('multiple_image');

        if (!$image) {
            return redirect()->back()->with([
                'message' => 'No image uploaded',
                'alert-type' => 'error',
            ]);
        }

        // Generate unique path (force JPG for better compression)
        $path = 'multi-image/' . Str::uuid() . '.jpg';

        try {
            // Resize & compress with Intervention
            $processedImage = Image::read($image)
                ->resize(1600, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode(new JpegEncoder(75)); // Quality: 75%

            // Upload to DigitalOcean Spaces
            Storage::disk('digitalocean')->put($path, (string) $processedImage, [
                'visibility' => 'public',
                'ContentType' => 'image/jpeg',
            ]);

            // Generate public URL
            $publicUrl = Storage::disk('digitalocean')->url($path);

            // Save to DB
            MultiImage::insert([
                'property_id' => $request->new_multi_image,
                'image' => $publicUrl,
                'created_at' => now(),
            ]);

            return redirect()->back()->with([
                'message' => 'Property Multi-Image Added Successfully',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            \Log::error('Multi-image upload failed: ' . $e->getMessage());

            return redirect()->back()->with([
                'message' => 'Image upload failed',
                'alert-type' => 'error',
            ]);
        }
    }

    // public function DeleteProperty($id)
    // {
    //     $property = Property::findOrFail($id);

    //     // Delete property thumbnail from Spaces
    //     if ($property->property_thumbnail) {
    //         $thumbnailPath = parse_url($property->property_thumbnail, PHP_URL_PATH);
    //         $bucket = config('filesystems.disks.digitalocean.bucket');

    //         // Remove bucket prefix from path
    //         $relativePath = preg_replace("/^\/?{$bucket}\//", '', ltrim($thumbnailPath, '/'));

    //         Storage::disk('digitalocean')->delete($relativePath);
    //     }

    //     // Delete property record
    //     $property->delete();

    //     // Delete all multi-images
    //     $multiImages = MultiImage::where('property_id', $id)->get();
    //     foreach ($multiImages as $img) {
    //         if ($img->image) {
    //             $imgPath = parse_url($img->image, PHP_URL_PATH);
    //             $bucket = config('filesystems.disks.digitalocean.bucket');

    //             $relativePath = preg_replace("/^\/?{$bucket}\//", '', ltrim($imgPath, '/'));

    //             Storage::disk('digitalocean')->delete($relativePath);
    //         }

    //         $img->delete(); // delete individual image record
    //     }

    //     return redirect()->back()->with([
    //         'message' => 'Property Deleted Successfully',
    //         'alert-type' => 'success',
    //     ]);
    // }

    public function DeleteProperty($id)
    {
        $property = Property::findOrFail($id);

        try {
            // Delete property thumbnail from Spaces
            if ($property->property_thumbnail) {
                $this->deleteFromSpaces($property->property_thumbnail);
            }

            // Delete all multi-images
            $multiImages = MultiImage::where('property_id', $id)->get();
            foreach ($multiImages as $img) {
                if ($img->image) {
                    $this->deleteFromSpaces($img->image);
                }
                $img->delete(); // delete individual image record
            }

            // Delete property record
            $property->delete();

            return redirect()->back()->with([
                'message' => 'Property Deleted Successfully',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            \Log::error('Property delete failed: ' . $e->getMessage());

            return redirect()->back()->with([
                'message' => 'Failed to delete property',
                'alert-type' => 'error',
            ]);
        }
    }

    /**
     * Helper function to delete a file from DigitalOcean Spaces
     */
    private function deleteFromSpaces($url)
    {
        $parsedPath = parse_url($url, PHP_URL_PATH);
        $bucket = config('filesystems.disks.digitalocean.bucket');

        // Remove bucket prefix from path
        $relativePath = preg_replace("/^\/?{$bucket}\//", '', ltrim($parsedPath, '/'));

        Storage::disk('digitalocean')->delete($relativePath);
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
