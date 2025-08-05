@php
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Property;

// Fetch properties that have any features_id (not null or empty)
$properties = Property::with('propertyType')
->where('status', 1)
->whereNotNull('features_id')
->where('features_id', '!=', '')
->latest()
->limit(3)
->get();

// Initialize wishlist for authenticated user
$userWishlist = [];

if (Auth::check()) {
$userWishlist = Wishlist::where('user_id', Auth::id())
->pluck('property_id')
->toArray();
}
@endphp


<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div
                    class="text-start mx-auto mb-5 wow slideInLeft"
                    data-wow-delay="0.1s">
                    <p class="caption">Hot Properties</p>
                    <h1 class="mb-3">Our Featured Properties</h1>
                    <p>
                        A property that is available for sale or rent, with a focus on
                        market valuation and maintenance. We are here to help you find
                        the best property for your needs and budget.
                    </p>
                </div>
            </div>
            <!-- <div
                class="col-lg-6 text-start text-lg-end wow slideInRight"
                data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    <li class="nav-item me-2">
                        <a
                            class="btn btn-outline-primary active"
                            data-bs-toggle="pill"
                            href="#tab-1">Featured</a>
                    </li>
                    <li class="nav-item me-2">
                        <a
                            class="btn btn-outline-primary"
                            data-bs-toggle="pill"
                            href="#tab-2">For Sell</a>
                    </li>
                    <li class="nav-item me-0">
                        <a
                            class="btn btn-outline-primary"
                            data-bs-toggle="pill"
                            href="#tab-3">For Rent</a>
                    </li>
                </ul>
            </div> -->
        </div>

        <div class="row g-4">
            @if(isset($properties) && count($properties))
            @foreach ($properties as $property)
            <div
                class="col-lg-4 col-md-6 wow fadeInUp"
                data-wow-delay="0.1s">
                @include('frontend.property.partials.property_card', ['property' => $property])
            </div>
            @endforeach
            @else
            <p class="text-center text-muted">No properties to show.</p>
            @endif
        </div>
        <div class="mt-3 text-center">
            <a href="{{ route('all.property.list') }}" class="btn btn-primary py-3 px-4 mt-4">View all Property</a>
        </div>
    </div>
</div>