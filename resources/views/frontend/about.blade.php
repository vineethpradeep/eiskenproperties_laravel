@extends('frontend.frontend-landingpage')

@section('main')

<!-- Header Start -->
<div class="container-fluid header bg-white p-0">
    @include('frontend.home.breadcrumb')
</div>
<!-- Header End -->

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s">
                <span class="caption">IT’S TIME TO KNOW ABOUT US </span>
                <h1 class="mb-4">Who We Are</h1>
                <p class="mb-4">
                    Eisken Properties was established in 2022 by Kimberley Richards,
                    along with our helpful team we deliver a customer-focused,
                    innovative approach to property letting and sales. We recognize
                    that letting a property can be a challenging experience for both
                    landlords and contract holders. However, both can enjoy the
                    benefits of an unrivaled customer service with our ‘Can Do’
                    approach.
                </p>
                <p class="fw-bold">
                    <i class="fa fa-check text-primary me-3"></i>ore than 25+ years
                    of experience
                </p>
                <p class="fw-bold">
                    <i class="fa fa-check text-primary me-3"></i>1000+ Clients
                    trusting our agency
                </p>
                <p class="fw-bold">
                    <i class="fa fa-check text-primary me-3"></i>500+ Satisfied Customers in the past 4 years
                </p>
                <a class="btn btn-primary py-3 px-5 mt-3" href="">View Policy</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Call to Action Start -->
<div class="container-fluid py-5 bg-primary-skin">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <img
                    class="img-fluid rounded w-100"
                    src="{{asset('frontend/assets/img/speak-to-us.svg')}}"
                    alt="Quiet Street" />
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="mb-4">
                    <h1 class="mb-3">Speak with a Licensed Property Expert</h1>
                    <p>
                        Our certified agents are fully licensed and trained to guide
                        you through every step of the buying, selling, and renting process. Whether you're ready to sign an agreement or just
                        exploring your options, our team is here to provide expert
                        advice, legal clarity, and trustworthy support
                    </p>
                </div>
                <a href="" class="btn btn-primary py-3 px-4 me-2"><i class="fa fa-phone-alt me-2"></i>Make A Call</a>
                <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get Appoinment</a>
            </div>
        </div>
    </div>
</div>
<!-- Call to Action End -->

<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div
            class="text-center mx-auto mb-5 wow fadeInUp"
            data-wow-delay="0.1s"
            style="max-width: 50%">
            <h1 class="mb-3">Here are our Teams</h1>
            <p>
                Our team at Eisken Properties is a dedicated group of
                professionals with diverse expertise in real estate. We are
                committed to delivering exceptional service, ensuring that each
                client’s unique needs are met with precision and care
            </p>
        </div>
        <div class="row g-4 d-flex justify-content-center">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item rounded overflow-hidden">
                    <div class="position-relative">
                        <img
                            class="img-fluid"
                            src="https://www.dummyimage.co.uk/600x400/cbcbcb/959595/Profile%20Image/40"
                            alt="" />
                        <div
                            class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4 mt-3">
                        <h5 class="fw-bold mb-0">Full Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item rounded overflow-hidden">
                    <div class="position-relative">
                        <img
                            class="img-fluid"
                            src="https://www.dummyimage.co.uk/600x400/cbcbcb/959595/Profile%20Image/40"
                            alt="" />
                        <div
                            class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4 mt-3">
                        <h5 class="fw-bold mb-0">Full Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item rounded overflow-hidden">
                    <div class="position-relative">
                        <img
                            class="img-fluid"
                            src="https://www.dummyimage.co.uk/600x400/cbcbcb/959595/Profile%20Image/40"
                            alt="" />
                        <div
                            class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="text-center p-4 mt-3">
                        <h5 class="fw-bold mb-0">Full Name</h5>
                        <small>Designation</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->
@endsection