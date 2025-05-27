 @extends('frontend.frontend-landingpage')

 @section('main')
 <!-- Contact form Start -->
 <div class="container-xxl py-5">
     <div class="container">
         <div
             class="text-center mx-auto mb-5 wow fadeInUp"
             data-wow-delay="0.1s">
             <h1 class="mb-3">Eisken Properties Admin Page</h1>
             <p class="caption">Admin Login</p>
         </div>
         <div class="row g-4">
             <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                 <img
                     class="img-fluid rounded w-100"
                     src="{{asset('frontend/assets/img/security_login.svg')}}"
                     alt="Quiet Street" />
             </div>
             <div class="col-md-6">
                 <div class="wow fadeInUp" data-wow-delay="0.5s">
                     <form action="{{route('login')}}" method="post">
                         @csrf
                         <div class="row g-3">
                             <div class="col-12">
                                 <div class="form-floating">
                                     <input
                                         type="text"
                                         class="form-control"
                                         id="login"
                                         name="login"
                                         placeholder="User Name / Email / Phone"
                                         autocomplete="off" />
                                     <label for="login">User Name / Email / Phone</label>
                                 </div>
                             </div>
                             <div class="col-12">
                                 <div class="form-floating">
                                     <input
                                         type="password"
                                         class="form-control"
                                         id="password"
                                         name="password"
                                         placeholder="Password"
                                         autocomplete="off" />
                                     <label for="password">Password</label>
                                 </div>
                             </div>
                             <div class="col-12">
                                 <button class="btn btn-primary w-100 py-3" type="submit">
                                     Sign In
                                 </button>
                             </div>
                             <div class="col-12 d-flex justify-content-center">
                                 <p class="text-muted">
                                     Have not an account?
                                     <a class="text-primary fw-bold" href="#">
                                         Register Now
                                     </a>
                                 </p>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Contact form End -->
 @endsection