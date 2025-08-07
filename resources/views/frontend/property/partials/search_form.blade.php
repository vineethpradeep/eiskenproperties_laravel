@php
$searchType = request('search_type', Str::contains($action, 'sale') ? 'sale' : (Str::contains($action, 'rent') ? 'rent' : 'all'));


$defaultPrices = [
'sale' => ['min' => 50000, 'max' => 5000000],
'rent' => ['min' => 250, 'max' => 10000],
'all' => ['min' => 250, 'max' => 5000000], // unified range for all
];

$defaultSqft = [
'sale' => ['min' => 100, 'max' => 10000],
'rent' => ['min' => 100, 'max' => 10000],
'all' => ['min' => 100, 'max' => 10000],
];

$selectedDefaults = $defaultPrices[$searchType];
$selectedSqftDefaults = $defaultSqft[$searchType];

$minPrice = request()->has('min_price') ? (int) request('min_price') : $selectedDefaults['min'];
$maxPrice = request()->has('max_price') ? (int) request('max_price') : $selectedDefaults['max'];

$minSqft = request()->has('min_square_feet') ? (int) request('min_square_feet') : $selectedSqftDefaults['min'];
$maxSqft = request()->has('max_square_feet') ? (int) request('max_square_feet') : $selectedSqftDefaults['max'];

$minSlider = $selectedDefaults['min'];
$maxSlider = $selectedDefaults['max'];

$stepSlider = $searchType === 'sale' ? 1000 : ($searchType === 'rent' ? 250 : 500); // adaptive step
$sqftStep = 100; // consistent step
@endphp



<div class="row">
    <div class="col-12">
        <form action="{{ $action }}" method="GET" data-search-type="{{ Str::contains($action, 'sale') ? 'sale' : (Str::contains($action, 'rent') ? 'rent' : 'all') }}">
            @csrf
            <input type="hidden" name="search_type" value="{{ $searchType }}" />
            <div class="row">
                <div
                    class="col-12 col-md-4 col-lg-4 mt-3 mt-lg-0">
                    <div class="form-floating">
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            id="properties"
                            placeholder="Search by property name (optional)"
                            autocomplete="off" />
                        <label for="properties">Search Properties</label>
                    </div>
                </div>

                <div
                    class="col-12 col-md-4 col-lg-4 mt-3 mt-lg-0">
                    <div class="form-floating custom-dropdown" data-options='@json($streetOptions)'>
                        <input
                            type="text"
                            name="street"
                            class="form-control dropdown-input"
                            placeholder="Street"
                            autocomplete="off"
                            value="{{ old('street', $property->street ?? '') }}" />
                        <label>Street</label>
                        <span class="dropdown-icon"><i class="fa-solid fa-chevron-down"></i></span>
                        <span class="clear-icon"><i class="fa-solid fa-xmark"></i></span>
                        <div class="dropdown-content">
                            <ul class="options"></ul>
                        </div>
                    </div>
                </div>

                <div
                    class="col-12 col-md-4 col-lg-4 mt-3 mt-lg-0">
                    @php
                    $propertyTypeOptions = ['Any Type'];
                    foreach ($propertyType as $ptype) {
                    $propertyTypeOptions[] = $ptype->property_type_name;
                    }
                    @endphp

                    <div
                        class="form-floating custom-dropdown"
                        data-options='@json($propertyTypeOptions)'>
                        <input
                            type="text"
                            class="form-control dropdown-input"
                            placeholder="Property Type"
                            name="property_type"
                            autocomplete="off" />
                        <label>Property Type</label>
                        <span class="dropdown-icon"><i class="fa-solid fa-chevron-down"></i></span>
                        <span class="clear-icon"><i class="fa-solid fa-xmark"></i></span>
                        <div class="dropdown-content">
                            <ul class="options"></ul>
                        </div>
                    </div>

                </div>

                <div
                    class="row {{ !empty($showMoreFilters) && $showMoreFilters ? 'more-filters-wrapper' : '' }} m-0 p-0">
                    <div
                        class="ol-12 col-md-4 col-lg-4 mt-3 mt-lg-4">
                        <div
                            class="form-floating custom-dropdown"
                            data-options='["Any Distance","Less than 1 km","Less than 2 km","Less than 3 km","Less than 4 km","Less than 5 km"]'>
                            <input
                                type="text"
                                class="form-control dropdown-input"
                                placeholder="Distance From Location"
                                autocomplete="off" />
                            <label>Distance From Location</label>
                            <span class="dropdown-icon"><i
                                    class="fa-solid fa-chevron-down"></i></span>
                            <span class="clear-icon"><i class="fa-solid fa-xmark"></i></span>
                            <div class="dropdown-content">
                                <ul class="options"></ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-12 col-lg-4 mt-3 mt-lg-4">
                        <div
                            class="form-floating custom-dropdown"
                            data-options='["Any","1","2","3","4","5+"]'>
                            <input
                                type="text"
                                name="bedrooms"
                                class="form-control dropdown-input"
                                placeholder="Bedrooms"
                                autocomplete="off" />
                            <label>Bedrooms</label>
                            <span class="dropdown-icon"><i
                                    class="fa-solid fa-chevron-down"></i></span>
                            <span class="clear-icon"><i class="fa-solid fa-xmark"></i></span>
                            <div class="dropdown-content">
                                <ul class="options"></ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-12 col-lg-4 mt-3 mt-lg-4">
                        <div
                            class="form-floating custom-dropdown"
                            data-options='["Any","1","2","3","4","5+"]'>
                            <input
                                type="text"
                                name="bathrooms"
                                class="form-control dropdown-input"
                                placeholder="Bathrooms"
                                autocomplete="off" />
                            <label>Bathrooms</label>
                            <span class="dropdown-icon"><i
                                    class="fa-solid fa-chevron-down"></i></span>
                            <span class="clear-icon"><i class="fa-solid fa-xmark"></i></span>
                            <div class="dropdown-content">
                                <ul class="options"></ul>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 col-lg-4 mt-3 mt-lg-4">
                        <div
                            class="form-floating custom-dropdown"
                            data-options='["Any","1","2","3", "4","5+"]'>
                            <input
                                type="text"
                                name="floors"
                                class="form-control dropdown-input"
                                placeholder="floors"
                                autocomplete="off" />
                            <label>Floors</label>
                            <span class="dropdown-icon"><i
                                    class="fa-solid fa-chevron-down"></i></span>
                            <span class="clear-icon"><i class="fa-solid fa-xmark"></i></span>
                            <div class="dropdown-content">
                                <ul class="options"></ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-12 col-lg-4 mt-3 mt-lg-4">
                        <div
                            class="range-slider"
                            data-prefix="£"
                            data-sale-min="50000"
                            data-sale-max="5000000"
                            data-sale-step="1000"
                            data-rent-min="250"
                            data-rent-max="10000"
                            data-rent-step="250"
                            data-all-min="250"
                            data-all-max="5000000"
                            data-all-step="500">
                            <div class="range-values">
                                <div class="label">Price Range</div>
                                <div class="value">
                                    <span class="rangeMinValue">£{{ number_format($minPrice) }}</span>
                                    -
                                    <span class="rangeMaxValue">£{{ number_format($maxPrice) }}</span>
                                </div>
                            </div>

                            <div class="range-bar">
                                <div class="range-slider-track"></div>

                                <input
                                    type="range"
                                    class="rangeMin"
                                    min="{{ $minSlider }}"
                                    max="{{ $maxSlider }}"
                                    value="{{ $minPrice }}"
                                    step="{{ $stepSlider }}" />
                                <input
                                    type="range"
                                    class="rangeMax"
                                    min="{{ $minSlider }}"
                                    max="{{ $maxSlider }}"
                                    value="{{ $maxPrice }}"
                                    step="{{ $stepSlider }}" />

                                <!-- Hidden inputs for form submission -->
                                <input type="hidden" name="min_price" class="hiddenMinPrice" value="{{ $minPrice }}" />
                                <input type="hidden" name="max_price" class="hiddenMaxPrice" value="{{ $maxPrice }}" />


                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 mt-3 mt-lg-4">
                        <div class="range-slider"
                            data-prefix="Sqft"
                            data-sale-min="100"
                            data-sale-max="10000"
                            data-sale-step="100"
                            data-rent-min="100"
                            data-rent-max="10000"
                            data-rent-step="100"
                            data-all-min="100"
                            data-all-max="10000"
                            data-all-step="100">

                            <div class="range-values">
                                <div class="label">Square Feet</div>
                                <div class="value">
                                    <span class="rangeMinValue">{{ number_format($minSqft) }}</span> -
                                    <span class="rangeMaxValue">{{ number_format($maxSqft) }}</span>
                                </div>
                            </div>

                            <div class="range-bar">
                                <div class="range-slider-track"></div>

                                <input
                                    type="range"
                                    class="rangeMin"
                                    min="{{ $selectedSqftDefaults['min'] }}"
                                    max="{{ $selectedSqftDefaults['max'] }}"
                                    value="{{ $minSqft }}"
                                    step="{{ $sqftStep }}" />
                                <input
                                    type="range"
                                    class="rangeMax"
                                    min="{{ $selectedSqftDefaults['min'] }}"
                                    max="{{ $selectedSqftDefaults['max'] }}"
                                    value="{{ $maxSqft }}"
                                    step="{{ $sqftStep }}" />

                                <!-- Hidden inputs for form submission -->
                                <input type="hidden" name="min_square_feet" class="hiddenMinSquareFeet" value="{{ $minSqft }}" />
                                <input type="hidden" name="max_square_feet" class="hiddenMaxSquareFeet" value="{{ $maxSqft }}" />
                            </div>
                        </div>
                    </div>

                </div>

                @if (!empty($showMoreFilters) && $showMoreFilters)
                <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-stretch gap-2 mt-4">
                    <div class="more-filter w-100 w-md-auto text-md-start text-center">
                        <a href="#">+ More filters</a>
                    </div>
                    <div class="form-group mb-0 w-100 w-md-auto">
                        <button type="submit" class="btn btn-primary w-100 w-md-auto">
                            Search
                        </button>
                    </div>
                </div>

                @else
                <div class="col-12 mt-4">
                    <div class="form-group mb-0">
                        <button
                            type="submit"
                            class="btn btn-primary w-100">
                            Search
                        </button>
                    </div>
                </div>
                @endif

            </div>
        </form>
    </div>
</div>