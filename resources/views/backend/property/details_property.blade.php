@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header align-item">
                <div class="card-title">Property Details</div>
                <form action="{{ route('toggle.property.status') }}" method="POST">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">

                    <ul class="nav nav-pills nav-primary">
                        <li class="nav-item">
                            <button
                                type="submit"
                                name="status"
                                value="1"
                                class="nav-link {{ $property->status == 1 ? 'active btn-success' : '' }}">
                                Active
                            </button>
                        </li>
                        <li class="nav-item">
                            <button
                                type="submit"
                                name="status"
                                value="0"
                                class="nav-link {{ $property->status == 0 ? 'active btn-danger' : '' }}">
                                Inactive
                            </button>
                        </li>
                    </ul>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Property Code</th>
                            <td>{{ $property->property_code }}</td>
                        </tr>
                        <tr>
                            <th>Property Availability</th>
                            <td class="text-primary">{{ $property->availabilityDate }}</td>
                        </tr>
                        <tr>
                            <th>Property Name</th>
                            <td>{{ $property->property_name }}</td>
                        </tr>
                        <tr>
                            <th>Property Type</th>
                            <td>{{ $property['propertyType']['property_type_name'] }}</td>
                        </tr>
                        <tr>
                            <th>Furnishing Status</th>
                            <td>{{ $property->furnishing }}</td>
                        </tr>
                        <tr>
                            <th>Property Category</th>
                            <td>{{ $property->property_category }}</td>
                        </tr>
                        <tr>
                            <th>Rent</th>
                            <td>{{ $property->rent }}</td>
                        </tr>
                        <tr>
                            <th>Deposit</th>
                            <td>{{ $property->deposit }}</td>
                        </tr>
                        <tr>
                            <th>Bedrooms</th>
                            <td>{{ $property->bedrooms }}</td>
                        </tr>
                        <tr>
                            <th>Bathrooms</th>
                            <td>{{ $property->bathrooms }}</td>
                        </tr>
                        <tr>
                            <th>Floors</th>
                            <td>{{ $property->floors }}</td>
                        </tr>
                        <tr>
                            <th>Size</th>
                            <td>{{ $property->property_size }}</td>
                        </tr>
                        <tr>
                            <th>EPC</th>
                            <td>{{ $property->epc }}</td>
                        </tr>
                        <tr>
                            <th>Council Band</th>
                            <td>{{ $property->council_band }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Hot / Fast Moving Property</th>
                        <td>{{ $property->hot }}</td>
                    </tr>
                    <tr>
                        <th>Property Status</th>
                        <td>{{ $property->property_status }}</td>
                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            <p>
                                {!! str_replace(['
                            <p>', '</p>'], '', $property->description) !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>Amenities</th>
                        <td>
                            <div class="selectgroup selectgroup-pills scrollable-box">
                                @foreach ($amenities as $amenity)
                                @if (in_array($amenity->id, $amenities_type))
                                <label class="selectgroup-item">
                                    <input type="checkbox" checked disabled class="selectgroup-input">
                                    <input type="hidden" name="amenities_id[]" value="{{ $amenity->id }}">
                                    <span class="selectgroup-button">{{ $amenity->amenitie_name }}</span>
                                </label>
                                @endif
                                @endforeach
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Property Location</div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Postalcode</th>
                            <td>{{ $property->postal_code }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $property->address }}</td>
                        </tr>
                        <tr>
                            <th>Street</th>
                            <td>{{ $property->street }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $property->city }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $property->country }}</td>
                        </tr>
                        <tr>
                            <th>School Distance</th>
                            <td>{{ $property->school_distance }}</td>
                        </tr>
                        <tr>
                            <th>Bus Stop Distance</th>
                            <td>{{ $property->bus_distance }}</td>
                        </tr>
                        <tr>
                            <th>Railway Station Distance</th>
                            <td>{{ $property->station_distance }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Property Map</div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <iframe
                        width="600"
                        height="450"
                        style="border:0; width: 100%"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}&hl=es;z=14&output=embed">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding-bottom: 40px;">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Property Images</div>
            </div>
            <div class="card-body">
                <figure class="imagecheck-figure">
                    <img src="{{ $property->property_thumbnail ?: 'https://bbxtbqstyfhfjybywyya.supabase.co/storage/v1/object/public/uploads/default-image/default_multi_image.jpg' }}"
                        alt="Main Image"
                        width="120" height="80">
                    @foreach($multiImage as $key => $img)
                    <img
                        src="{{ asset($img->image ?: 'https://bbxtbqstyfhfjybywyya.supabase.co/storage/v1/object/public/uploads/default-image/default_multi_image.jpg') }}" alt="Image" width="100"
                        alt="Image Thumbnail" />
                    @endforeach

                </figure>

            </div>
        </div>
    </div>
</div>


@endsection