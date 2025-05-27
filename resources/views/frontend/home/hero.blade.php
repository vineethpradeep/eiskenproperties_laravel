<!--hero section start-->
<div class="videoTourContainer">
    <div class="videoTour">
        <video autoplay muted loop>
            <source src="{{asset('frontend/assets/img/coverr-tour.mp4')}}" type="video/mp4" />
            Your browser does not support the video tag.
        </video>
        <div class="row">
            <div class="col-md-12">
                <div class="overlay"></div>
                <div class="highLight container-xxl">
                    <div class="bg">
                        <div class="highLight-content">
                            <h1>Find Your Perfect Property</h1>
                            <div class="text-line">
                                <span>Your search in one place</span>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Advanced Search Start -->
                                    @include('frontend.home.advanceSearch')
                                    <!-- Advanced Search End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="jumbotron-infobar">
                    <div class="widget">
                        <div class="row">
                            <div class="col-12 col-md col-lg">
                                <div class="info-box d-flex align-items-start">
                                    <div class="icon mr-3">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="info">
                                        <h4>Phone number:</h4>
                                        <span>+44 1792 644023</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-lg-auto">
                                <div class="info-box d-flex align-items-start">
                                    <div class="icon mr-3">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="info">
                                        <h4>Opening times:</h4>
                                        <span>Mon - Thu: 9:00 AM to 5:00 PM, Fri - until 2:00
                                            PM</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md col-lg">
                                <div class="info-box d-flex align-items-start">
                                    <div class="icon mr-3">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="info">
                                        <h4>Email address:</h4>
                                        <span>enquiries@eiskenp.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->