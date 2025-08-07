@extends('frontend.frontend-landingpage')
@section('main')

@php
use Illuminate\Support\Facades\Auth;

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
<!-- Header Start -->
<div class="container-fluid header bg-white p-0">
    @include('frontend.home.breadcrumb')
</div>
<!-- Header End -->

<!-- Property List Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div
                    class="text-start mx-auto mb-5 wow slideInLeft"
                    data-wow-delay="0.1s">
                    <p class="caption">Properties List</p>
                    <h1 class="mb-3">{{$category === 'sales' ? 'On Sales Properties' : 'On Rent Properties'}}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 border rounded p-3 property-list-filter-form">
                <ul class="nav nav-tabs mb-3" id="searchTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $category === 'rent' ? 'active' : '' }}" id="rent-tab"
                            data-bs-toggle="tab" data-bs-target="#rent-form" type="button" role="tab"
                            aria-selected="{{ $category === 'rent' ? 'true' : 'false' }}">
                            Rent
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $category === 'sales' ? 'active' : '' }}" id="sale-tab"
                            data-bs-toggle="tab" data-bs-target="#sale-form" type="button" role="tab"
                            aria-selected="{{ $category === 'sales' ? 'true' : 'false' }}">
                            Sale
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="searchTabsContent">
                    <div class="tab-pane fade {{ $category === 'rent' ? 'show active' : '' }}" id="rent-form" role="tabpanel" aria-labelledby="rent-tab">
                        @include('frontend.property.partials.search_form', ['action' => route('property.search.rent'), 'showMoreFilters' => false])
                    </div>
                    <div class="tab-pane fade {{ $category === 'sales' ? 'show active' : '' }}" id="sale-form" role="tabpanel" aria-labelledby="sale-tab">
                        @include('frontend.property.partials.search_form', ['action' => route('property.search.sale'), 'showMoreFilters' => false])
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                @if ($properties->isNotEmpty())
                <div class="col-12 text-center">
                    <div class="bg-white widget-form border rounded p-3 mb-3">
                        <h3 class="h5 text-black mb-0">
                            Search Results:
                            <span class="text-primary small">
                                Showing {{ $properties->count() }} {{ Str::plural('property', $properties->count()) }}
                            </span>
                        </h3>
                    </div>
                </div>

                <div class="row g-4" id="property-container">
                    @foreach ($properties as $property)
                    <div class="property-item-wrap col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        @include('frontend.property.partials.property_card', ['property' => $property])
                    </div>
                    @endforeach
                </div>

                <div class="col-md-12 text-center mt-5">
                    <div id="pagination-container"></div>
                </div>
                @else
                <div class="col-12 text-center">
                    <div class="bg-white widget-form border rounded p-3">
                        <h3 class="h5 text-black mb-0">No properties found.</h3>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Property List End -->

@endsection