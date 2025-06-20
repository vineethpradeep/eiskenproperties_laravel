 @extends('frontend.frontend-landingpage')

 @section('header')
 @include('frontend.home.breadcrumb')
 @endsection


 @section('main')

 @if(session('error'))
 <div class="alert alert-danger">
     {{ session('error') }}
 </div>
 @endif
 <!-- Contact form Start -->
 <div class="container-xxl py-5">
     <div class="container">
         <div
             class="text-center mx-auto mb-5 wow fadeInUp"
             data-wow-delay="0.1s">
             <h1 class="mb-3">Eisken Properties Welcomes You</h1>
             <p class="caption">Employees, log in | Users & Agents</p>
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
                 <img
                     class="img-fluid rounded w-100"
                     src="{{asset('frontend/assets/img/security_login.svg')}}"
                     alt="Quiet Street" />
             </div>
             <div class="col-md-6">
                 <div class="wow fadeInUp" data-wow-delay="0.5s">
                     <form action="{{route('login')}}" method="post" id="loginForm">
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
                                         autocomplete="off"
                                         required />
                                     <label for="login">User Name / Email / Phone</label>
                                     <small class="text-danger">@error('login') {{ $message }} @enderror</small>
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
                                         autocomplete="off"
                                         required />
                                     <label for="password">Password</label>
                                     <small class="text-danger">@error('password') {{ $message }} @enderror</small>
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
                                     <a class="text-primary fw-bold" href="{{route('register')}}">
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

 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const form = document.getElementById("loginForm");
         const loginInput = document.getElementById("login");
         const passwordInput = document.getElementById("password");

         form.addEventListener("submit", function(event) {
             let errors = [];

             document.getElementById("loginError").textContent = "";
             document.getElementById("passwordError").textContent = "";

             if (loginInput.value.trim() === "") {
                 errors.push({
                     field: "loginError",
                     message: "Username / Email / Phone is required."
                 });
             }

             if (passwordInput.value.trim().length < 6) {
                 errors.push({
                     field: "passwordError",
                     message: "Password must be at least 6 characters."
                 });
             }

             if (errors.length > 0) {
                 event.preventDefault();
                 errors.forEach(error => {
                     document.getElementById(error.field).textContent = error.message;
                 });
             }
         });
     });
 </script>