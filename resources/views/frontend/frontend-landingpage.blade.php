<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Eisken Properties - Find Your Perfect Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
        name="description"
        content="Discover the perfect rental property for students, new home buyers, or lease agreements. Eisken Properties offers a wide range of properties and services to meet your housing needs." />
    <meta
        name="keywords"
        content="rental, student rental, buy a house, properties, lease, contract, housing, real estate, student housing, property management, rental agreements, home buying, Eisken Properties" />
    <meta name="author" content="Eisken Properties" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link href="{{asset('frontend/assets/img/favicon.ico')}}" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Libraries Stylesheet -->
    <link
        href="{{asset('frontend/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}"
        rel="stylesheet" />

    <link href="{{asset('frontend/assets/lib/animate/animate.min.css')}}" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend/assets/css/customStyle.css')}}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/css/nice-select.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>

<body>
    <!--Preloader-->
    @include('frontend.home.preloader')
    <!--end preloader-->
    <!-- END LOADER -->
    <div class="container-fluid bg-white p-0">
        <!-- Navbar Start -->
        @include('frontend.home.navbar')
        <!-- Navbar End -->

        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            @yield('header')
        </div>
        <!-- Header End -->

        <!--index Start-->
        @yield('main')
        <!--index End-->

        <!-- Footer Start -->
        @include('frontend.home.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        @include('frontend.home.topScroll')
        <!--end back to top-->
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if (Session::has('message'))
    <script>
        var type = "{{ Session::get('alert-type', 'info') }}";
        var message = "{{ Session::get('message') }}";

        switch (type) {
            case 'info':
                toastr.info(message);
                break;
            case 'success':
                toastr.success(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'error':
                toastr.error(message);
                break;
        }
    </script>
    @endif
    <script type="text/javascript">
        function toggleWishlist(element) {
            const propertyId = element.getAttribute('data-id');
            const icon = element.querySelector('i');

            fetch(`/wishlist/toggle/${propertyId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (response.status === 401) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Login Required',
                            text: 'Please log in to use the Wishlist for property inquiries and tracking.',
                            confirmButtonText: 'OK'
                        });
                        throw new Error('Unauthenticated');
                    }

                    return response.json();
                })
                .then(data => {
                    // Always remove both classes first
                    icon.classList.remove('text-muted', 'text-danger');

                    if (data.status === 'added') {
                        icon.classList.add('text-danger');
                    } else if (data.status === 'removed') {
                        icon.classList.add('text-muted');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong: ' + error.message,
                        confirmButtonText: 'OK'
                    });
                });
        }


        function showLoginAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'Login Required',
                text: 'Please log in to use the Wishlist for property inquiries and tracking.',
                confirmButtonText: 'Login',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend/assets/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <!-- Template Javascript -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins.js')}}"></script>
    <!-- Bootstrap 5 Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>