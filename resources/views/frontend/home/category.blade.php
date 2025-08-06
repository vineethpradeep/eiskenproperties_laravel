@php
use App\Models\Property;
use App\Models\PropertyType;

$allPropertyTypes = PropertyType::all()->map(function ($type) {
$activeCount = Property::where('ptype_id', $type->id)
->where('status', 1)
->count();

return [
'id' => $type->id,
'name' => $type->property_type_name,
'icon' => $type->property_icon ?? 'fa-building',
'count' => $activeCount,
];
})->filter(function ($type) {
return $type['count'] > 0;
})->values();

$staticTypes = $allPropertyTypes->take(4);
$sliderTypes = $allPropertyTypes->slice(4);
@endphp

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px">
            <h1 class="mb-3">We have the perfect property waiting for you!</h1>
            <p>
                From cozy homes to grand estates, our property portfolio is designed to impress.
                Here’s what we currently have available:
            </p>
        </div>

        <div class="row g-4">
            @foreach ($staticTypes as $item)
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item d-block bg-light text-center rounded p-3">
                    <div class="rounded p-4">
                        <div class="icon mb-3">
                            <i class="fa-solid {{ $item['icon'] }}"></i>
                        </div>
                        <h6>{{ $item['name'] }}</h6>
                        <span>{{ $item['count'] }} Properties</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        @if ($sliderTypes->count())
        <div class="mt-5">
            <div class="owl-carousel owl-theme">
                @foreach ($sliderTypes as $item)
                <div class="item">
                    <a class="cat-item d-block bg-light text-center rounded p-3" href="#">
                        <div class="rounded p-4">
                            <div class="icon mb-3">
                                <i class="fa-solid {{ $item['icon'] }}"></i>
                            </div>
                            <h6>{{ $item['name'] }}</h6>
                            <span>{{ $item['count'] }} Properties</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>