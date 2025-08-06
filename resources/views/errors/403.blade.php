<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>403 Error</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
        name="description"
        content="Discover the perfect rental property for students, new home buyers, or lease agreements. Eisken Properties offers a wide range of properties and services to meet your housing needs." />
    <meta
        name="keywords"
        content="rental, student rental, buy a house, properties, lease, contract, housing, real estate, student housing, property management, rental agreements, home buying, Eisken Properties" />
    <meta name="author" content="Eisken Properties" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/assets/js/bootstrap.bundle.min.js"></script>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend/assets/css/customStyle.css')}}" rel="stylesheet" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Template Stylesheet -->
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet" />
</head>

<body>
    <!-- END LOADER -->
    <div class="container-fluid bg-white p-0">
        <!-- 404 Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                        <h1 class="display-1">403</h1>
                        <h1 class="mb-4">Forbidden Access</h1>
                        <p class="mb-4">
                            We’re sorry, you do not have permission to access this page.
                        </p>
                        <a class="btn btn-primary py-3 px-5" href="{{url('/')}}">Go Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404 End -->
    </div>
</body>

</html>