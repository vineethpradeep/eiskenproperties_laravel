<div class="row">
    <div class="col-12">
        <form action="{{ $action }}" method="GET">
            @csrf
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
                            data-options='["Any","1","2","3","4","5"]'>
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
                            data-options='["Any","1","2","3","4","5"]'>
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
                            data-options='["Any","1","2","3"]'>
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
                            data-prefix="£">
                            <div class="range-values">
                                <div class="label">
                                    Rent Range
                                </div>
                                <div class="value">
                                    <span class="rangeMinValue">250</span>
                                    -
                                    <span class="rangeMaxValue">10000</span>
                                </div>
                            </div>
                            <div class="range-bar">
                                <div
                                    class="range-slider-track"></div>
                                <input
                                    type="range"
                                    class="rangeMin"
                                    name="min_rent"
                                    min="250"
                                    max="10000"
                                    value="250"
                                    step="50" />
                                <input
                                    type="range"
                                    class="rangeMax"
                                    name="max_rent"
                                    min="250"
                                    max="10000"
                                    value="3000"
                                    step="50" />
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-12 col-lg-4 mt-3 mt-lg-4">
                        <div
                            class="range-slider"
                            data-prefix="Sqft ">
                            <div class="range-values">
                                <div class="label">
                                    Square Feet
                                </div>
                                <div class="value">
                                    <span class="rangeMinValue">600</span>
                                    -
                                    <span class="rangeMaxValue">20000</span>
                                </div>
                            </div>
                            <div class="range-bar">
                                <div
                                    class="range-slider-track"></div>
                                <input
                                    type="range"
                                    class="rangeMin"
                                    name="min_square_feet"
                                    min="400"
                                    max="5000"
                                    value="600"
                                    step="50" />
                                <input
                                    type="range"
                                    class="rangeMax"
                                    name="max_square_feet"
                                    min="400"
                                    max="5000"
                                    value="3000"
                                    step="50" />
                            </div>
                        </div>
                    </div>
                </div>

                @if (!empty($showMoreFilters) && $showMoreFilters)
                <div class="col-12 d-flex justify-content-between align-items-end mt-4">
                    <div class="more-filter">
                        <a href="#">+ More filters</a>
                    </div>
                    <div class="form-group mb-0">
                        <button
                            type="submit"
                            class="btn btn-primary">
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
                            Filter
                        </button>
                    </div>
                </div>
                @endif

            </div>
        </form>
    </div>
</div>