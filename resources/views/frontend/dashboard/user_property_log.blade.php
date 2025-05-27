@extends('frontend.frontend-landingpage')

@section('header')
@include('frontend.home.breadcrumb')
@endsection

@section('main')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            @include('frontend.dashboard.user_profile_detail')
            <div class="col-lg-8">
                <div class="bg-white property-body border border-top">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="h4 text-black mb-3">
                                @if ($type === 'wishlist')
                                Hi {{ $userName}}, <span class="text-primary font-bold"> {{ count($userWishlist ?? []) }} </span> Whishlisted so for
                                @elseif ($type === 'enquiry')
                                Hi {{ $userName}}, <span class="text-primary font-bold"> {{ count($enquiry ?? []) }} </span> Enquiry so for
                                @endif
                            </h3>
                            <div class="d-flex propery-info">
                                <ul>
                                    <li>
                                        <i class="fa-regular fa-clock me-2"></i>{{ now()->format('F d, Y') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters mt-5">
                        <div class="col-12">
                            <h2 class="h4 text-black mb-3">
                                @if ($type === 'wishlist')
                                Property Wishlist Log
                                @elseif ($type === 'enquiry')
                                Property Enquiry Log
                                @endif
                            </h2>
                            <div class="row">
                                @if ($properties->count())
                                @foreach ($properties as $property)
                                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    @include('frontend.property.partials.property_card', ['property' => $property])
                                </div>
                                @endforeach
                                @else
                                <p>No properties in your {{ $type }}.</p>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection