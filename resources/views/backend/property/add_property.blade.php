@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Property</div>
                <form action="{{route('store.property')}}" id="propertyForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Property Category</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_category"
                                                value="rent"
                                                class="selectgroup-input validate-on-change"
                                                checked />
                                            <span class="selectgroup-button">Rent</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_category"
                                                value="sales"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Sales</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="ptype_id">Property Type</label>
                                    <select
                                        class="form-select form-control validate-on-change"
                                        id="ptype_id" name="ptype_id">
                                        <option value="" selected>Choose Type...</option>
                                        @foreach($propertyType as $ptype)
                                        <option value="{{$ptype->id}}">{{$ptype->property_type_name}}</option>
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
                                        name="property_name" required />
                                </div>
                            </div>
                        </div>
                        <div class="row row-card-no-pd mt--2">
                            <div class="col-12 col-md-4 col-lg-4 mb-3" id="rentDepositSection">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="rent">Rent</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">£</span>
                                                <input type="text" class="form-control" name="rent" id="rent" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="deposit">Deposit</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">£</span>
                                                <input type="text" class="form-control" name="deposit" id="deposit" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4 mb-3" id="priceSection" style="display: none;">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">£</span>
                                        <input type="text" class="form-control" name="price" id="price" />
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="property_thumbnail">Main Image</label>
                                    <input type="hidden" id="existing_image" value="{{ isset($property) ? $property->property_thumbnail : '' }}">
                                    <input
                                        type="file"
                                        class="form-control validate-on-change"
                                        name="property_thumbnail"
                                        id="property_thumbnail"
                                        accept="image/*" />

                                    <div class="col-6 col-sm-4" id="mainImgCol">
                                        <label class="imagecheck mt-4">
                                            <input id="mainThmbCheck" type="checkbox" class="imagecheck-input" checked>
                                            <figure class="imagecheck-figure">
                                                <img id="mainThmbImg" src="https://placehold.co/600x400" alt="Thumbnail" class="imagecheck-image" width="80" height="80">
                                            </figure>
                                        </label>
                                        <button id="deleteBtn" class="btn btn-black mt-2" disabled>Delete</button>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="multiImageInput">Multiple Image</label>
                                    <input type="hidden" id="existing_multi_images" value="{{ isset($property) ? $property->multiple_image : '' }}">
                                    <input
                                        type="file"
                                        class="form-control validate-on-change"
                                        name="multiple_image[]"
                                        id="multiImageInput"
                                        multiple />
                                    <div class="multiImgCol">
                                        <div id="previewContainer" class="row mt-3">
                                        </div>
                                        <button id="multiImagedeleteBtn" class="btn btn-black mt-2" disabled>Delete</button>
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
                                            <input
                                                list="bedroomOptions"
                                                type="number"
                                                min="1"
                                                class="form-control validate-on-change"
                                                id="bedrooms"
                                                name="bedrooms"
                                                placeholder="Select or type number"
                                                required />

                                            <datalist id="bedroomOptions">
                                                <?php for ($i = 1; $i <= 30; $i++): ?>
                                                    <option value="<?= $i ?>"></option>
                                                <?php endfor; ?>
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="bathrooms">Bathrooms</label>

                                            <!-- Input with datalist suggestions 1–30 -->
                                            <input
                                                list="bathroomOptions"
                                                type="number"
                                                min="1"
                                                class="form-control validate-on-change"
                                                id="bathrooms"
                                                name="bathrooms"
                                                placeholder="Select or type number"
                                                required />

                                            <datalist id="bathroomOptions">
                                                <?php for ($i = 1; $i <= 30; $i++): ?>
                                                    <option value="<?= $i ?>"></option>
                                                <?php endfor; ?>
                                            </datalist>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="floors">Floors</label>
                                            <input
                                                list="floorOptions"
                                                type="number"
                                                min="1"
                                                class="form-control validate-on-change"
                                                id="floors"
                                                name="floors"
                                                placeholder="Select or type number"
                                                required />
                                            <datalist id="floorOptions">
                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                    <option value="<?= $i ?>"></option>
                                                <?php endfor; ?>
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="property_size">Property Size</label>
                                            <input
                                                type="nunber"
                                                class="form-control validate-on-change"
                                                id="property_size" name="property_size" />
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
                                                id="epc" name="epc">
                                                <option value="" disabled selected>Select</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
                                            </select>
                                        </div>



                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="council_band">Council Tax Band</label>
                                            <select
                                                class="form-select form-control validate-on-change"
                                                id="council_band" name="council_band">
                                                <option value="" disabled selected>Select</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>
                                                <option value="E">E</option>
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
                                        <label class="selectgroup-item">
                                            <input
                                                type="checkbox"
                                                name="featured"
                                                value="garage"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Garage</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="checkbox"
                                                name="featured"
                                                value="pool"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Pool</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="checkbox"
                                                name="featured"
                                                value="garden"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Garden</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="checkbox"
                                                name="featured"
                                                value="car_parking"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Car Parking</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="checkbox"
                                                name="featured"
                                                value="bike_parking"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Bike Parking</span>
                                        </label>
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
                                        id="property_video" disabled />

                                </div>
                            </div>

                            <div class="col-12 col-md-2 col-lg-2 mb-3">
                                <div class="form-group">
                                    <label for="neighborhood">Neighborhood</label>
                                    <select
                                        class="form-select form-control"
                                        id="neighborhood" disabled>
                                        <option value="downtown">Downtown</option>
                                        <option value="suburbia">Suburbia</option>
                                        <option value="uptown">Uptown</option>
                                        <option value="old_town">Old Town</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row row-card-no-pd mt--2">
                            <h3 class="fw-bold mb-3">Property Location <span class="h6">(Search the postcode to populate the address and location)</span></h3>
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
                                                    id="street" name="street" />
                                            </div>


                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
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
                                                    id="latitude" name="latitude" />
                                            </div>

                                        </div>
                                        <div class="col-4 mb-2">
                                            <div class="form-group">
                                                <label for="longitude">Longitude</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="longitude" name="longitude" />
                                            </div>
                                        </div>
                                        <div class="col-4 mb-2">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
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
                                                        id="station_distance" />
                                                    <span class="input-group-text">miles</span>
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
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">{{ $amenity->amenitie_name }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-md-4 col-lg-4 mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="form-group">
                                            <label for="furnishing">Furnishing Status</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input
                                                        type="radio"
                                                        name="furnishing"
                                                        value="furnished"
                                                        class="selectgroup-input" />
                                                    <span class="selectgroup-button">Furnished</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input
                                                        type="radio"
                                                        name="furnishing"
                                                        value="unfurnished"
                                                        class="selectgroup-input"
                                                        checked="" />
                                                    <span class="selectgroup-button">Unfurnished</span>
                                                </label>
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
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Yes</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="hot"
                                                value="no"
                                                class="selectgroup-input"
                                                checked="" />
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
                                    <textarea id="editor" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label">Property Status</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_status"
                                                value="available"
                                                class="selectgroup-input"
                                                checked="" />
                                            <span class="selectgroup-button">Available</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_status"
                                                value="reserved"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Reserved</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_status"
                                                value="let_agreed"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Let Agreed</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_status"
                                                value="sold"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Sold</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input
                                                type="radio"
                                                name="property_status"
                                                value="under_offer"
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Under Offer</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit">Save Property</button>
                        </div>
                </form>

            </div>
        </div>

    </div>
</div>
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
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
                    required: false,
                },
                price: {
                    required: function() {
                        let propertyCategory = $('input[name="property_category"]:checked').val();
                        return propertyCategory === 'sale';
                    },
                    digits: true
                },
                property_thumbnail: {
                    required: function() {
                        let existingImage = $('#existing_image').val().trim();
                        return existingImage !== '' || $('#property_thumbnail').get(0).files.length > 0;
                    }
                },
                'multiple_image[]': {
                    required: function() {
                        let existingImages = $('#existing_multi_images').val().trim();
                        return existingImages !== '' || $('#multiImageInput').get(0).files.length > 0;
                    }
                },
                bedrooms: {
                    required: false
                },
                bathrooms: {
                    required: true
                },
                floors: {
                    required: false
                },
                property_size: {
                    required: false
                },
                epc: {
                    required: false
                },
                council_band: {
                    required: false
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
    document.addEventListener('DOMContentLoaded', function() {
        const rentDepositSection = document.getElementById('rentDepositSection');
        const priceSection = document.getElementById('priceSection');
        const categoryRadios = document.querySelectorAll('input[name="property_category"]');

        function toggleFields() {
            const selectedCategory = document.querySelector('input[name="property_category"]:checked').value;

            if (selectedCategory === 'rent') {
                rentDepositSection.style.display = 'block';
                priceSection.style.display = 'none';

                document.getElementById('price').value = '';
                document.getElementById('price').removeAttribute('required');

                document.getElementById('rent').setAttribute('required', 'required');
                document.getElementById('deposit').setAttribute('required', 'required');
            } else {
                rentDepositSection.style.display = 'none';
                priceSection.style.display = 'block';

                document.getElementById('rent').value = '';
                document.getElementById('deposit').value = '';
                document.getElementById('rent').removeAttribute('required');
                document.getElementById('deposit').removeAttribute('required');

                document.getElementById('price').setAttribute('required', 'required');
            }
        }

        categoryRadios.forEach(radio => {
            radio.addEventListener('change', toggleFields);
        });

        // Initial toggle on page load
        toggleFields();
    });
</script>
@endsection