@extends('frontend.frontend-landingpage')

@section('main')

<!-- Header Start -->
<div class="container-fluid header bg-white p-0">
    @include('frontend.home.breadcrumb')
</div>
<!-- Header End -->

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div
            class="text-center mx-auto mb-5 wow fadeInUp"
            data-wow-delay="0.1s"
            style="max-width: 600px">
            <p class="caption">Get in Touch with</p>
            <h1 class="mb-3">Eisken Properties LLC</h1>
            <p>
                Have questions or need more details? Reach out to Eisken
                Properties and we're here to help! Our team aims to respond as soon as possible within 1-2 business days. Whether you're buying, renting, or just
                exploring, we’re happy to assist you every step of the way.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-12">
                <div class="row gy-4">
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                        <div class="bg-light rounded p-3">
                            <div
                                class="d-flex align-items-center bg-white rounded p-3"
                                style="border: 1px dashed rgb(237 172 21)">
                                <div class="icon me-3" style="width: 45px; height: 45px">
                                    <i class="fa fa-map-marker-alt text-primary"></i>
                                </div>
                                <span>76 Mansel Street Swansea SA1 5TW</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="bg-light rounded p-3">
                            <div
                                class="d-flex align-items-center bg-white rounded p-3"
                                style="border: 1px dashed rgb(237 172 21)">
                                <div class="icon me-3" style="width: 45px; height: 45px">
                                    <i class="fa fa-envelope-open text-primary"></i>
                                </div>
                                <span>enquiries@eiskenp.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                        <div class="bg-light rounded p-3">
                            <div
                                class="d-flex align-items-center bg-white rounded p-3"
                                style="border: 1px dashed rgb(237 172 21)">
                                <div class="icon me-3" style="width: 45px; height: 45px">
                                    <i class="fa fa-phone-alt text-primary"></i>
                                </div>
                                <span>+44 1792 644023</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <iframe
                    class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps?q=51.6209369,-3.9498767&hl=es;z=14&output=embed">
                    frameborder="0"
                    style="min-height: 400px; border: 0"
                    allowfullscreen=""
                    aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <p class="mb-4">
                        Please fill out the form below to send us your inquiry. Your
                        details help us respond quickly and accurately to your query.
                        All information is securely handled and used only to provide
                        the support and assistance you need. We value your privacy and
                        are committed to protecting your personal data.
                    </p>
                    @include('frontend.property.partials.contact_form', ['property' => null])
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection