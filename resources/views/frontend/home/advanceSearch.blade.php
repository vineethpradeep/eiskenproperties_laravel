@php
$propertyType = App\Models\PropertyType::latest()->get();

$streetOptions = ['All Streets'];
$streetList = \App\Models\Property::whereNotNull('street')
->where('street', '!=', '')
->distinct()
->orderBy('street')
->pluck('street')
->filter()
->values();

foreach ($streetList as $street) {
$streetOptions[] = $street;
}
@endphp

<div class="advanced-search-form">
    <div class="container">
        <ul class="nav nav-tabs mb-3" id="searchTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="rent-tab" data-bs-toggle="tab" data-bs-target="#rent-form" type="button" role="tab" aria-controls="rent-form" aria-selected="true">
                    For Rent
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale-form" type="button" role="tab" aria-controls="sale-form" aria-selected="false">
                    For Sale
                </button>
            </li>
        </ul>

        <div class="tab-content" id="searchTabContent">
            <!-- Sale Form -->
            <div class="tab-pane fade" id="sale-form" role="tabpanel" aria-labelledby="sale-tab">
                @include('frontend.property.partials.search_form', ['action' => route('property.search.sale'), 'showMoreFilters' => true])
            </div>

            <!-- Rent Form -->
            <div class="tab-pane fade show active" id="rent-form" role="tabpanel" aria-labelledby="rent-tab">
                @include('frontend.property.partials.search_form', ['action' => route('property.search.rent'), 'showMoreFilters' => true])
            </div>
        </div>
    </div>
</div>