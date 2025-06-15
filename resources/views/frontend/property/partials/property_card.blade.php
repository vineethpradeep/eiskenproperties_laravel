<div class="property-item rounded overflow-hidden position-relative">
    <div class="position-relative overflow-hidden">
        <a href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}">
            <img class="img-fluid"
                src="{{ $property->property_thumbnail ?: 'https://bbxtbqstyfhfjybywyya.supabase.co/storage/v1/object/public/uploads/default-image/default_image.jpg' }}"
                alt="Property Image" />
        </a>
        <div class="bg-primary rounded text-white position-absolute end-0 top-0  m-4 py-1 px-3">
            For {{ $property->property_category }}
        </div>
        @if ($property->featured)
        <div class="feature-tag">
            <div id="pointer">Featured</div>
        </div>
        @endif
    </div>

    <div class="fav-type">
        <div class="bg-white rounded-top text-dark start-0 bottom-0 d-inline-flex align-items-center mx-4 pt-1 px-3 bg-light fw-bold">
            {{ $property->propertyType->property_type_name ?? 'Unknown' }}
        </div>
        <div class="property-favorite mx-2 shadow-sm">
            @php
            $isInWishlist = in_array($property->id, $userWishlist ?? []);
            @endphp
            @if(Auth::check())
            <a data-id="{{ $property->id }}" onclick="toggleWishlist(this)" style="cursor: pointer;">
                <i class="fa fa-heart {{ $isInWishlist ? 'text-danger' : 'text-muted' }}"></i>
            </a>
            @else
            <a href="{{ route('login') }}" onclick="event.preventDefault(); showLoginAlert();">
                <i class="fa fa-heart text-muted"></i>
            </a>
            @endif
        </div>
    </div>

    <div class="p-4 pb-0">
        <h5 class="text-primary mb-3 mt-2">£{{ $property->rent }}</h5>
        <a class="d-block h5 mb-2" href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}">
            {{ $property->property_name }}
        </a>
        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}</p>
    </div>

    <div class="d-flex border-top">
        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->property_size }} Sqft</small>
        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{ $property->bedrooms }} Bed</small>
        <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{ $property->bathrooms }} Bath</small>
    </div>
</div>