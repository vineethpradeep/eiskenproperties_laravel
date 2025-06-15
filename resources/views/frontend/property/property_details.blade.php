@extends('frontend.frontend-landingpage')

@section('main')

<!-- Header Start -->
<div class="container-fluid header bg-white p-0">
    @include('frontend.home.breadcrumb')
</div>
<!-- Header End -->

<!-- Call to Action Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="slide-one-item home-slider">
                    <div class="slider">
                        <div class="bigImage">
                            <div class="arrow arrow-left">
                                <i class="fas fa-chevron-left"></i>
                            </div>
                            <!-- <img
                      alt=""
                      src="https://res.cloudinary.com/eiskenproperties/image/upload/v1738520480/posts/interior_7_lsygfq.jpg"
                    /> -->
                            <div class="slider-wrapper">
                                <div class="slider-track"></div>
                            </div>
                            <div class="arrow arrow-right">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                        <div class="smallImages">
                            @foreach($multiImage as $image)
                            <img
                                alt="{{$property->property_name}}"
                                src="{{asset($image->image ?: 'https://bbxtbqstyfhfjybywyya.supabase.co/storage/v1/object/public/uploads/default-image/default_multi_image.jpg')}}" />
                            @endforeach
                            <!-- <img
                                alt=""
                                src="https://res.cloudinary.com/eiskenproperties/image/upload/v1738520484/posts/interior_10_zmeidt.jpg" />
                            <img
                                alt=""
                                src="https://res.cloudinary.com/eiskenproperties/image/upload/v1738520486/posts/interior_9_ojwdcr.jpg" /> -->
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white property-body border-bottom border-left border-right">
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <strong class="text-primary h1 mb-3">£{{$property->rent}}</strong>
                            <h1 class="address">
                                {{$property->property_name}},
                                <address>
                                    {{$property->address}}, {{$property->street}}, {{$property->city}}, {{$property-> postal_code}}
                                </address>
                            </h1>
                            <div class="d-flex propery-info">
                                <ul>
                                    <li>
                                        <i class="fa fa-ruler-combined me-2"></i>{{$property->property_size}} Sqft
                                    </li>
                                    <li><i class="fa fa-bed me-2"></i>{{$property->bedrooms}} Bed</li>
                                    <li><i class="fa fa-bath me-2"></i>{{$property->bathrooms}} Bath</li>
                                    <li>
                                        <i class="fa fa-chart-bar me-2"></i>EPC - {{$property->epc}} Rating
                                        <span class="info"><i data-feather="info" class="me-2"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div
                            class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
                            <strong class="d-block">{{$property->propertyType->property_type_name}}</strong>
                        </div>
                        <!-- <div
                            class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
                            <strong class="d-block"> {{ !empty($property->property_year) ? $property->property_year : 'N/A' }}</strong>
                        </div> -->
                        <div
                            class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Property Category</span>
                            <strong class="d-block">For {{$property->property_category }}</strong>
                        </div>
                        <div
                            class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
                            <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
                            <strong class="d-block">£{{$property->property_size * 5,000}}</strong>
                        </div>
                    </div>
                    <h2 class="h4 text-black">More Property Info</h2>
                    <p>
                        {!! $property->description !!}
                    </p>
                    <!-- <p>
                        It comes with reliable gas, electricity, and 24/7 water
                        supply, along with covered parking for two vehicles. Located
                        in a secure, gated community, the property provides peace of
                        mind and privacy. Conveniently situated near Swansea City
                        Centre, top-rated schools, shops, and public transport, this
                        home combines convenience, comfort, and quality making it an
                        ideal choice for your next move
                    </p> -->

                    <div class="row no-gutters mt-5">
                        <div class="col-12">
                            <h2 class="h4 text-black mb-3">Property Amenities</h2>
                            <ul class="row-cols-3 amenity-list">
                                @foreach($propertyAmenities as $amenity)
                                <li class="col">
                                    <p class="fw-bold">
                                        <i class="fa fa-check text-success me-3"></i>{{$amenity->amenitie_name}}
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row no-gutters mt-5">
                        <div class="col-12">
                            <h2 class="h4 text-black mb-3">Property Location Map</h2>
                            <div class="rounded">
                                <div
                                    class="d-flex align-items-center bg-white rounded p-3"
                                    style="border: 1px dashed rgb(237 172 21)">
                                    <iframe
                                        width="600"
                                        height="450"
                                        style="border:0; width: 100%"
                                        loading="lazy"
                                        allowfullscreen
                                        referrerpolicy="no-referrer-when-downgrade"
                                        src="https://www.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}&hl=es;z=14&output=embed">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters mt-5">
                        <div class="col-12">
                            <h2 class="h4 text-black mb-3">What's Nearby</h2>
                            <div class="row gy-4">
                                <div
                                    class="col-md-3 col-lg-6 wow fadeIn"
                                    data-wow-delay="0.1s"
                                    style="
                          visibility: visible;
                          animation-delay: 0.1s;
                          animation-name: fadeIn;
                        ">
                                    <div class="rounded">
                                        <div
                                            class="d-flex align-items-center bg-white rounded p-3"
                                            style="border: 1px dashed rgb(237 172 21)">
                                            <div class="icon" style="width: 45px; height: 45px">
                                                <i class="fa fa-train-tram text-primary"></i>
                                            </div>
                                            <span>Railway Station {{$property->station_distance}} miles</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-md-3 col-lg-6 wow fadeIn"
                                    data-wow-delay="0.5s"
                                    style="
                          visibility: visible;
                          animation-delay: 0.5s;
                          animation-name: fadeIn;
                        ">
                                    <div class="rounded">
                                        <div
                                            class="d-flex align-items-center bg-white rounded p-3"
                                            style="border: 1px dashed rgb(237 172 21)">
                                            <div class="icon" style="width: 45px; height: 45px">
                                                <i class="fa fa-bus-simple text-primary"></i>
                                            </div>
                                            <span>Bus Station {{$property-> bus_distance}} miles</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div
                                    class="col-md-3 col-lg-6 wow fadeIn"
                                    data-wow-delay="0.3s"
                                    style="
                          visibility: visible;
                          animation-delay: 0.3s;
                          animation-name: fadeIn;
                        ">
                                    <div class="rounded">
                                        <div
                                            class="d-flex align-items-center bg-white rounded p-3"
                                            style="border: 1px dashed rgb(237 172 21)">
                                            <div class="icon" style="width: 45px; height: 45px">
                                                <i class="fa fa-school text-primary"></i>
                                            </div>
                                            <span>enquiries@eiskenp.com</span>
                                        </div>
                                    </div>
                                </div> -->
                                <div
                                    class="col-md-3 col-lg-6 wow fadeIn"
                                    data-wow-delay="0.5s"
                                    style="
                          visibility: visible;
                          animation-delay: 0.5s;
                          animation-name: fadeIn;
                        ">
                                    <div class="rounded">
                                        <div
                                            class="d-flex align-items-center bg-white rounded p-3"
                                            style="border: 1px dashed rgb(237 172 21)">
                                            <div class="icon" style="width: 45px; height: 45px">
                                                <i class="fa fa-graduation-cap text-primary"></i>
                                            </div>
                                            <span>School {{ $property->school_distance }} miles</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white widget-form border rounded">
                    <div class="d-flex">
                        <span
                            class="bg-dark rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 55px; height: 55px"><span class="text-white agent-name">A</span></span>
                        <div class="ps-3">
                            @if($property->agent_id == null)
                            <h6 class="fw-bold mb-1">Agent Eisken Property</h6>
                            @else
                            <h6 class="fw-bold mb-1">{{$property->agent->name}}</h6>
                            @endif
                            <small>Profession</small>
                            <p class="mb-2">
                                <i class="fa fa-phone-alt me-3"></i>+44 01792 644023
                            </p>
                            <button type="button" class="btn btn-secondary py-2 w-100">
                                Enquiry Now
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white widget-form border rounded">
                    <h3 class="h4 text-black mb-3">Contact Agent</h3>
                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" autocomplete="off" required />
                                    <label for="name">Name</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="off" required />
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" maxlength="10" autocomplete="off" required />
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <input type="submit" class="btn btn-primary" value="Send" />
                            </div>
                        </div>
                    </form>

                </div>

                <div class="bg-white widget-form border rounded">
                    <h3 class="h4 text-black mb-3">Schedule a View</h3>
                    <form id="propertyViewForm" action="{{ route('schedule.viewing') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input
                                        type="date"
                                        class="form-control"
                                        id="date"
                                        name="view_date"
                                        placeholder="Date"
                                        autocomplete="off"
                                        required />
                                    <label for="date">Viewing Date</label>
                                </div>
                            </div>
                            <div class="col-12">
                                @php
                                $start = strtotime('09:00');
                                $end = strtotime('17:00');
                                $timeSlots = [];

                                while ($start <= $end) {
                                    $timeSlots[]=date('g:i A', $start);
                                    $start=strtotime('+30 minutes', $start);
                                    }

                                    $jsonTimeSlots=json_encode($timeSlots);
                                    @endphp

                                    <div class="form-floating custom-dropdown" data-options='@json($timeSlots)'>
                                    <input
                                        type="text"
                                        name="view_time"
                                        class="form-control dropdown-input"
                                        placeholder="Select Viewing Time"
                                        autocomplete="off"
                                        required />
                                    <label for="view_time">Viewing Time</label>
                                    <span class="dropdown-icon">
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </span>
                                    <span class="clear-icon">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                    <div class="dropdown-content">
                                        <ul class="options"></ul>
                                    </div>
                            </div>


                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="view_name"
                                    placeholder="Name"
                                    autocomplete="off"
                                    required />
                                <label for="name">Name</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    placeholder="Email"
                                    name="view_email"
                                    autocomplete="off"
                                    required />
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone"
                                    name="view_phone"
                                    placeholder="Phone Number"
                                    maxlength="10"
                                    autocomplete="off"
                                    required />
                                <label for="phone">Phone Number</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea
                                    class="form-control"
                                    placeholder="Leave a message here"
                                    id="message"
                                    name="view_message"
                                    style="height: 150px"
                                    autocomplete="off"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <input
                                type="submit"
                                class="btn btn-primary"
                                value="Request Viewing" />
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Call to Action End -->

<!-- Property List Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div
                    class="text-start mx-auto mb-5 wow slideInLeft"
                    data-wow-delay="0.1s">
                    <h1 class="mb-3">Similar Properties</h1>
                    <p>
                        Explore similar properties with matching style, budget, and
                        location each offering the same high standards and proximity
                        to Swansea City Centre, schools, and key amenities
                    </p>
                </div>
            </div>
        </div>
        <div class="row g-4">
            <div class="property-slider-container position-relative">
                <button class="slider-arrow left">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <div class="property-slider overflow-hidden">
                    <div class="property-slider-track d-flex">
                        @foreach($similarProperty as $property)
                        <div
                            class="col-lg-4 col-md-6 wow fadeInUp"
                            data-wow-delay="0.1s">
                            <div
                                class="property-item rounded overflow-hidden position-relative">
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}">
                                        <img
                                            class="img-fluid"
                                            src="{{asset($property->property_thumbnail)}}"
                                            alt="" /></a>
                                    <div
                                        class="bg-primary rounded text-white position-absolute end-0 top-0  m-4 py-1 px-3">
                                        For {{$property->property_category}}
                                    </div>
                                    <!-- <span class="features-icon text-primary position-absolute top-0 end-0"><i class="fa-solid fa-bolt-lightning"></i></span> -->
                                    @if ($property->featured)
                                    <div class="feature-tag">
                                        <div id="pointer">Featured</div>
                                    </div>
                                    @endif
                                </div>
                                <div class="fav-type">
                                    <div
                                        class="bg-white rounded-top text-primary start-0 bottom-0 d-inline-flex align-items-center mx-4 pt-1 px-3 bg-light">
                                        {{ $property->propertyType->property_type_name ?? 'Unknown' }}
                                    </div>
                                    <div href="#" class="property-favorite mx-2 shadow-sm">
                                        @php
                                        $isInWishlist = in_array($property->id, $userWishlist);
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
                                    <h5 class="text-primary mb-3 mt-2">£{{$property->rent}}</h5>
                                    <a class="d-block h5 mb-2" href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}">{{$property->property_name}}</a>
                                    <p>
                                        <i class="fa fa-map-marker-alt text-primary me-2"></i>{{$property->address}}
                                    </p>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$property->property_size}} Sqft</small>
                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$property->bedrooms}} Bed</small>
                                    <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$property->bathrooms}}
                                        Bath</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button class="slider-arrow right">
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Property List End -->
@endsection
<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
    feather.replace();
    $(document).ready(function() {
        // Initialize the slider
        $("#propertyViewForm").validate({
            rules: {
                view_date: {
                    required: true,
                    date: true
                },
                view_time: {
                    required: true
                },
                view_name: {
                    required: true,
                    minlength: 2
                },
                view_email: {
                    required: true,
                    email: true
                },
                view_phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                view_message: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                view_date: {
                    required: "Please select a date"
                },
                view_time: {
                    required: "Please select a time"
                },
                view_name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 2 characters"
                },
                view_email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email"
                },
                view_phone: {
                    required: "Please enter your phone number",
                    digits: "Only numbers are allowed",
                    minlength: "Phone number must be 10 digits",
                    maxlength: "Phone number must be 10 digits"
                },
                view_message: {
                    required: "Please enter a message",
                    minlength: "Message must be at least 10 characters"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-floating').after(error);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>