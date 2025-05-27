@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Property</div>
                <form action="{{route('update.property')}}" id="propertyForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{$property->id}}">

                    <div class="card-body">
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                @php
                                $categories = ['rent' => 'Rent', 'sales' => 'Sales'];
                                $selectedCategory = $property->property_category ?? null;
                                @endphp

                                <div class="form-group">
                                    <label class="form-label">Property Category</label>
                                    <div class="selectgroup w-100">
                                        @foreach($categories as $value => $label)
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_category"
                                                value="{{ $value }}"
                                                class="selectgroup-input validate-on-change"
                                                {{ $selectedCategory === $value ? 'checked' : '' }} />
                                            <span class="selectgroup-button">{{ $label }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="ptype_id">Property Type</label>
                                    <select
                                        class="form-select form-control validate-on-change"
                                        id="ptype_id" name="ptype_id">

                                        <option value="" disabled {{ $property->ptype_id == '' ? 'selected' : '' }}>Choose Type...</option>

                                        @foreach($propertyType as $ptype)
                                        <option value="{{ $ptype->id }}" {{ $property->ptype_id == $ptype->id ? 'selected' : '' }}>
                                            {{ $ptype->property_type_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">

                                <div class="form-group">
                                    <label for="property_name">Property Name</label>
                                    <input
                                        type="text"
                                        class="form-control validate-on-change"
                                        id="property_name"
                                        name="property_name" required value="{{$property->property_name}}" />
                                </div>
                            </div>
                        </div>
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="rent">Rent</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">£</span>
                                                <input
                                                    type="text"
                                                    class="form-control validate-on-change"
                                                    name="rent"
                                                    id="rent"
                                                    aria-label="Amount (to the nearest dollar)" value="{{ isset($property->rent) ? $property->rent : '' }}" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="deposit">Deposit</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">£</span>
                                                <input
                                                    type="text"
                                                    class="form-control validate-on-change"
                                                    name="deposit"
                                                    id="deposit"
                                                    aria-label="Amount (to the nearest dollar)" value="{{ isset($property->deposit) ? $property->deposit : '' }}" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="bedrooms">Bedrooms</label>
                                            <select
                                                class="form-select form-control validate-on-change"
                                                id="bedrooms" name="bedrooms" required>
                                                <option value="" disabled {{$property->bedrooms == '' ? 'selected' : ''}}>Select</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" {{ $property->bedrooms == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                    </option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="bathrooms">Bathrooms</label>
                                            <select
                                                class="form-select form-control validate-on-change"
                                                id="bathrooms" name="bathrooms" required>
                                                <option value="" disabled {{$property->bathrooms == '' ? 'selected' : ''}}>Select</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" {{ $property->bathrooms == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                    </option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="floors">Floors</label>
                                            <select
                                                class="form-select form-control validate-on-change"
                                                id="floors" name="floors" required>
                                                <option value="" disabled {{$property->floors == '' ? 'selected' : ''}}>Select</option>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" {{ $property->floors == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                    </option>
                                                    @endfor
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="property_size">Property Size</label>
                                            <input
                                                type="nunber"
                                                class="form-control validate-on-change"
                                                id="property_size" name="property_size" value="{{$property->property_size}}" required />
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="epc">EPC</label>
                                            <select
                                                class="form-select form-control validate-on-change"
                                                id="epc" name="epc" required>
                                                <option value="" disabled {{$property->epc == '' ? 'selected' : ''}}>Select</option>
                                                @foreach (['A', 'B', 'C', 'D', 'E'] as $grade)
                                                <option value="{{ $grade }}" {{ $property->epc == $grade ? 'selected' : '' }}>
                                                    {{ $grade }}
                                                </option>
                                                @endforeach

                                            </select>
                                        </div>



                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="council_band">Council Tax Band</label>
                                            <select
                                                class="form-select form-control validate-on-change"
                                                id="council_band" name="council_band" required>
                                                <option value="" disabled {{$property->council_band == '' ? 'selected' : ''}}>Select</option>
                                                @foreach (['A', 'B', 'C', 'D', 'E'] as $grade)
                                                <option value="{{ $grade }}" {{ $property->council_band == $grade ? 'selected' : '' }}>
                                                    {{ $grade }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label d-block">Property Features</label>
                                    <div class="selectgroup selectgroup-pills scrollable-box">
                                        @php
                                        $selectedFeatures = old('featured', $property->featured ?? []);
                                        if (is_string($selectedFeatures)) {
                                        $selectedFeatures = explode(',', $selectedFeatures); // if stored as comma string
                                        }
                                        @endphp

                                        @foreach(['garage', 'pool', 'garden', 'car_parking', 'bike_parking'] as $feature)
                                        <label class="selectgroup-item">
                                            <input
                                                type="checkbox"
                                                name="featured[]"
                                                value="{{ $feature }}"
                                                class="selectgroup-input"
                                                {{ in_array($feature, $selectedFeatures) ? 'checked' : '' }} />
                                            <span class="selectgroup-button">{{ ucfirst(str_replace('_', ' ', $feature)) }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="property_video">Property Video</label>
                                    <input
                                        type="file"
                                        class="form-control"
                                        name="property_video"
                                        value="{{ $property->property_video }}"
                                        id="property_video" />

                                </div>
                            </div>

                            <div class="col-12 col-md-2 col-lg-2 mb-3">
                                <div class="form-group">
                                    <label for="neighborhood">Neighborhood</label>
                                    <select
                                        class="form-select form-control"
                                        id="neighborhood" name="neighborhood">
                                        <option value="" disabled {{ $property->neighborhood == '' ? 'selected' : '' }}>Choose...</option>
                                        <option value="downtown" {{ $property->neighborhood == 'downtown' ? 'selected' : '' }}>Downtown</option>
                                        <option value="suburbia" {{ $property->neighborhood == 'suburbia' ? 'selected' : '' }}>Suburbia</option>
                                        <option value="uptown" {{ $property->neighborhood == 'uptown' ? 'selected' : '' }}>Uptown</option>
                                        <option value="old_town" {{ $property->neighborhood == 'old_town' ? 'selected' : '' }}>Old Town</option>

                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row row-card-no-pd mt--2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Property Location <span class="h6">(Search the postcode to populate the address and location)</span></h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4 col-lg-3 mb-3">
                                            <div class="form-group">
                                                <label for="postal_code">Postcode</label>
                                                <div class="input-group">
                                                    <button
                                                        class="btn btn-black btn-border"
                                                        type="button" id="searchButton">
                                                        Search
                                                    </button>
                                                    <input
                                                        type="text"
                                                        id="postcodeInput"
                                                        class="form-control"
                                                        placeholder="eg., SA14LN"
                                                        aria-label=""
                                                        aria-describedby="basic-addon1"
                                                        value="{{ $property->postal_code }}"
                                                        name="postal_code" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4 col-lg-4 mb-3">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ $property->address }}"
                                                    id="address" name="address" />
                                            </div>

                                        </div>

                                        <div class="col-12 col-md-4 col-lg-5 mb-3">
                                            <div class="row">
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label for="street">Street</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ $property->street }}"
                                                            id="street" name="street" />
                                                    </div>


                                                </div>
                                                <div class="col-6 mb-2">
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ $property->city }}"
                                                            id="city" name="city" />
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 mb-3">
                                            <div class="row">
                                                <div class="col-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="latitude">Latitude</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ $property->latitude }}"
                                                            id="latitude" name="latitude" />
                                                    </div>

                                                </div>
                                                <div class="col-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="longitude">Longitude</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ $property->longitude }}"
                                                            id="longitude" name="longitude" />
                                                    </div>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="country">Country</label>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            value="{{ $property->country }}"
                                                            id="country" name="country" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-6 mb-3">
                                            <div class="row">
                                                <div class="col-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="school_distance">School Distance</label>
                                                        <div class="input-group mb-3">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="school_distance"
                                                                value="{{ $property->school_distance }}"
                                                                id="school_distance" />
                                                            <span class="input-group-text">miles</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="bus_distance">Bus Stop Distance</label>
                                                        <div class="input-group mb-3">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="bus_distance"
                                                                value="{{ $property->bus_distance }}"
                                                                id="bus_distance" />
                                                            <span class="input-group-text">miles</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="station_distance">Railway Station Distance</label>
                                                        <div class="input-group mb-3">
                                                            <input
                                                                type="text"
                                                                class="form-control"
                                                                name="station_distance"
                                                                value="{{ $property->station_distance }}"
                                                                id="station_distance" />
                                                            <span class="input-group-text">miles</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-12 col-md-6 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label class="form-label d-block">Property Amenities</label>
                                    <div class="selectgroup selectgroup-pills scrollable-box">
                                        @foreach ($amenities as $amenity)
                                        <label class="selectgroup-item">
                                            <input
                                                type="checkbox"
                                                name="amenities_id[]"
                                                value="{{ $amenity->id }}"
                                                class="selectgroup-input"
                                                {{ in_array($amenity->id, $amenities_type) ? 'checked' : '' }} />
                                            <span class="selectgroup-button">{{ $amenity->amenitie_name }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>


                            </div>
                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        @php
                                        $furnishingOptions = ['furnished' => 'Furnished', 'unfurnished' => 'Unfurnished'];
                                        $selectedFurnishing = $property->furnishing ?? null;
                                        @endphp

                                        <div class="form-group">
                                            <label for="furnishing">Furnishing Status</label>
                                            <div class="selectgroup w-100">
                                                @foreach($furnishingOptions as $value => $label)
                                                <label class="selectgroup-item">
                                                    <input
                                                        type="radio"
                                                        name="furnishing"
                                                        value="{{ $value }}"
                                                        class="selectgroup-input"
                                                        {{ $selectedFurnishing === $value ? 'checked' : '' }} />
                                                    <span class="selectgroup-button">{{ $label }}</span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="property_name">Property Availability</label>
                                            <input
                                                type="date"
                                                class="form-control validate-on-change"
                                                id="availabilityDate"
                                                value="{{ $property->availabilityDate }}"
                                                name="availabilityDate" required />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-md-2 col-lg-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Hot Property</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="hot"
                                                value="yes"
                                                class="selectgroup-input"
                                                {{ old('hot', $property->hot) == 'yes' ? 'checked' : '' }} />
                                            <span class="selectgroup-button">Yes</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="hot"
                                                value="no"
                                                class="selectgroup-input"
                                                {{ old('hot', $property->hot) == 'no' ? 'checked' : '' }} />
                                            <span class="selectgroup-button">No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="description">Property Description</label>
                                    <textarea id="editor" name="description">{{ $property->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 mb-2">
                                @php
                                $selectedStatus = old('property_status', $property->property_status ?? 'available');
                                @endphp
                                <div class="form-group">
                                    <label class="form-label">Property Status</label>
                                    <div class="selectgroup w-100">
                                        @foreach (['available', 'reserved', 'let_agreed', 'sold', 'under_offer'] as $status)
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_status"
                                                value="{{ $status }}"
                                                class="selectgroup-input"
                                                {{ $selectedStatus === $status ? 'checked' : '' }} />
                                            <span class="selectgroup-button">{{ ucwords(str_replace('_', ' ', $status)) }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit">Update Property</button>
                        </div>
                </form>

            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Main Property Image</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('update.property.thumbnail')}}" id="propertyForm" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{$property->id}}">
                        <input type="hidden" name="old_property_thumbnail_image" value="{{$property->property_thumbnail}}">
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-12 col-md-12 col-lg-12 mb-3">
                                <!-- <div class="form-group">
                                    <label for="property_thumbnail">Main Image</label>
                                    <input
                                        type="file"
                                        class="form-control validate-on-change"
                                        name="property_thumbnail"
                                        id="property_thumbnail"
                                        accept="image/*"
                                        onchange="mainThamUrl(this)" />

                                    <div class="col-6 col-sm-4 flex" id="mainImgCol">
                                        <div class="imagecheck mt-4">
                                            <input id="mainThmbCheck" type="checkbox" class="imagecheck-input" checked>
                                            <figure class="imagecheck-figure">
                                                <img id="mainThmbImg" src="{{ $property->property_thumbnail ? asset($property->property_thumbnail) : 'https://placehold.co/600x400' }}" alt="Thumbnail" class="imagecheck-image" width="80" height="80">
                                            </figure>
                                        </div>
                                        <button id="deleteBtn" class="btn btn-black mt-2" disabled>Delete</button>
                                    </div> -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Current Main Image</th>
                                            <th>Replace With</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ $property->property_thumbnail ? asset($property->property_thumbnail) : 'https://placehold.co/600x400' }}"
                                                    alt="Main Image"
                                                    width="120" height="80">
                                            </td>
                                            <td>
                                                <input type="file"
                                                    name="property_thumbnail"
                                                    class="form-control"
                                                    accept="image/*"
                                                    onchange="mainThamUrl(this)">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-sm btn-primary">Save</button>

                                                @if ($property->property_thumbnail)
                                                <a href=""
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete the main image?')">
                                                    Delete
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <di v class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Multiple Property Details Image</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('store.new.multiimage')}}" id="propertyForm" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="new_multi_image" value="{{ $property->id }}">
                        <div class="form-group">
                            <table class="table table-bordered">

                                <tr>
                                    <td>
                                        <input type="file" name="multiple_image" class="form-control" id="multiImageInput">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-info">Add Image</button>
                                    </td>
                                </tr>
                            </table>

                        </div>

                    </form>
                    <form action="{{route('update.property.multiimage')}}" id="propertyForm" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <div class="card-body">
                            <div class="row row-card-no-pd mt--2">
                                <div class="col-12 col-md-12 col-lg-12 mb-3">
                                    <div class="form-group">
                                        <!-- @foreach ($multiImage as $img)
                                        <div class="form-group mb-3">
                                            <label for="image_{{ $img->id }}">Replace Image</label>
                                            <input type="file" name="multiple_image[{{ $img->id }}]" class="form-control">
                                        </div>
                                        @endforeach

                                        Hidden field to store which images to delete
                                        <input type="hidden" name="deleted_existing_images" id="deleted_existing_images" value="[]">
                                        @php
                                        $multiImgStyle = count($multiImage) > 0 ? '' : 'display: none;';
                                        @endphp
                                        <div id="multiImgCol" class="multiImgCol {{ count($multiImage) === 0 ? 'd-none' : '' }}">
                                            <div id="previewContainer" class="row mt-3">
                                                @foreach ($multiImage as $index => $img)
                                                <div class="col-6 col-sm-4 mb-3 existing-image">
                                                    <label class="imagecheck w-100">
                                                        <input
                                                            type="checkbox"
                                                            class="imagecheck-input"
                                                            data-existing="true"
                                                            data-index="{{ $index }}"
                                                            data-filename="{{ $img->image }}" />
                                                        <figure class="imagecheck-figure">
                                                            <img src="{{ asset($img->image) }}" alt="Thumbnail" class="imagecheck-image" width="100%">
                                                        </figure>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>

                                            <button
                                                type="button"
                                                class="btn btn-black mt-2"
                                                id="multiImagedeleteBtn"
                                                disabled>
                                                Delete
                                            </button>
                                        </div> -->
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Current Image</th>
                                                    <th>Replace Image</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($multiImage as $key => $img)
                                                <tr>
                                                    <td>{{ $key + 1  }}</td>
                                                    <td>
                                                        <img src="{{ asset($img->image) }}" alt="Image" width="100">
                                                    </td>
                                                    <td>
                                                        <input type="file" name="multiple_image[{{ $img->id }}]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-primary">Update Image</button>

                                                        <a href="{{route('property.multiimage.delete', ['id' => $img->id])}}"
                                                            class="btn btn-sm btn-danger multiImagedeleteBtn">
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>


                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>

</div>

</div>

<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script> -->
<script>
    $(document).ready(function() {
        $("#propertyForm").validate({
            rules: {
                property_name: {
                    required: true,
                },
                property_category: {
                    required: true,
                },
                ptype_id: {
                    required: true,
                },
                rent: {
                    required: true,
                },
                deposit: {
                    required: true,
                },
                property_thumbnail: {
                    required: function(element) {
                        return $('#property_thumbnail').get(0).files.length === 0;
                    }
                },
                'multiple_image[]': {
                    required: function(element) {
                        return $('#multiImageInput').get(0).files.length === 0;
                    }
                },
                bedrooms: {
                    required: true
                },
                bathrooms: {
                    required: true
                },
                floors: {
                    required: true
                },
                property_size: {
                    required: true
                },
                council_band: {
                    required: true
                },
                epc: {
                    required: true
                },
                council_band: {
                    required: true
                },
                postcodeInput: {
                    required: true
                },
                availabilityDate: {
                    required: true
                },
                'amenities_id[]': {
                    required: true,
                    minlength: 1
                }

            },
            messages: {
                property_name: {
                    required: "Please enter property name",
                },
                property_category: {
                    required: "Please select a property category",
                },
                ptype_id: {
                    required: "Please select a property type",
                },
                rent: {
                    required: "Please enter rent",
                },
                deposit: {
                    required: "Please enter deposit",
                },
                property_thumbnail: {
                    required: "Please upload a main image",
                    extension: "Only image files (jpg, jpeg, png, gif, webp) are allowed"
                },
                'multiple_image[]': {
                    required: "Please upload multiple images",
                    extension: "Only image files (jpg, jpeg, png, gif, webp) are allowed"
                },
                bedrooms: {
                    required: "Please select bedrooms"
                },
                bathrooms: {
                    required: "Please select bathrooms"
                },
                floors: {
                    required: "Please select floors"
                },
                property_size: {
                    required: "Please enter property size"
                },
                council_band: {
                    required: "Please enter council band"
                },
                epc: {
                    required: "Please enter epc"
                },
                council_band: {
                    required: "Please enter council band"
                },
                postcodeInput: {
                    required: "Please enter postcode"
                },
                availabilityDate: {
                    required: "Please enter availability date"
                },
                'amenities_id[]': {
                    required: "Please select at least one amenity.",
                    minlength: "Select at least one amenity."
                }

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    })
</script>
@endsection