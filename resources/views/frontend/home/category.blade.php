@php
$PropertyType = App\Models\PropertyType::latest()->limit(4)->get();
@endphp

<div class="container-xxl py-5">
    <div class="container">
        <div
            class="text-center mx-auto mb-5 wow fadeInUp"
            data-wow-delay="0.1s"
            style="max-width: 600px">
            <h1 class="mb-3">We have the perfect property waiting for you!</h1>
            <p>
                From cozy homes to grand estates, our property portfolio is
                designed to impress. Here’s what we currently have available :
            </p>
        </div>
        <div class="row g-4">
            @foreach ($PropertyType as $item)

            @php
            $property = App\Models\Property::where('ptype_id', $item->id)->get();
            @endphp

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a
                    class="cat-item d-block bg-light text-center rounded p-3"
                    href="">
                    <div class="rounded p-4">
                        <div class="icon mb-3">
                            <i class="fa-solid {{$item->property_icon ?? 'fa-building'}}"></i>
                        </div>
                        <h6>{{$item->property_type_name}}</h6>
                        <span>{{count($property)}} Properties</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>