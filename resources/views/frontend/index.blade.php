@extends('frontend.frontend-landingpage')

@section('header')
@include('frontend.home.hero')
@endsection

@section('main')
<!-- Category Start -->
@include('frontend.home.category')
<!-- Category End -->

<!-- About Start -->
@include('frontend.home.about')
<!-- About End -->

<!-- Feature Property List Start -->
@include('frontend.home.feature')
<!-- Feature Property List End -->

<!-- Call to Action Start -->
@include('frontend.home.howItWorks')
<!-- Call to Action End -->

<!-- Testimonial Start -->
@include('frontend.home.testimonial')
<!-- Testimonial End -->

<!-- subscribe Start -->
@include('frontend.home.subscribe')
<!-- subscribe End -->
@endsection