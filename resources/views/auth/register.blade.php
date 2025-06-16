 @extends('frontend.frontend-landingpage')

 @section('header')
 @include('frontend.home.breadcrumb')
 @endsection


 @section('main')
 <!-- Contact form Start -->
 <div class="container-xxl py-5">
     <div class="container">
         <div
             class="text-center mx-auto mb-5 wow fadeInUp"
             data-wow-delay="0.1s">
             <h1 class="mb-3">Eisken Properties Welcomes You</h1>
             <p class="caption">Employees, Register | Users & Agents</p>
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
                     <form action="{{ route('register') }}" method="POST">
                         @csrf
                         <div class="row g-3">
                             <div class="col-12">
                                 <div class="form-floating">
                                     <input
                                         type="text"
                                         class="form-control"
                                         id="name"
                                         name="name"
                                         placeholder="Name"
                                         autocomplete="off"
                                         required />
                                     <label for="name">User Name</label>
                                     <small class="text-danger">@error('name') {{ $message }} @enderror</small>
                                 </div>
                             </div>
                             <div class="col-12">
                                 <div class="form-floating">
                                     <input
                                         type="email"
                                         class="form-control"
                                         id="email"
                                         name="email"
                                         placeholder="Email"
                                         autocomplete="off"
                                         required />
                                     <label for="email">Email</label>
                                     <small class="text-danger">@error('email') {{ $message }} @enderror</small>
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
                                 <div class="form-floating">
                                     <input
                                         type="password"
                                         class="form-control"
                                         id="password_confirmation"
                                         name="password_confirmation"
                                         placeholder="Password"
                                         autocomplete="off"
                                         required />
                                     <label for="password_confirmation">Confirm Password</label>
                                     <small class="text-danger">@error('password_confirmation') {{ $message }} @enderror</small>
                                 </div>
                             </div>
                             <div class="col-12">
                                 <button class="btn btn-primary w-100 py-3" type="submit">
                                     Register
                                 </button>
                             </div>
                             <div class="col-12 d-flex justify-content-center">
                                 <p class="text-muted">
                                     Already have an account?
                                     <a class="text-primary fw-bold" href="{{route('login')}}">
                                         Sign In
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

 <script type="text/javascript">
     document.addEventListener("DOMContentLoaded", function() {
         const form = document.getElementById("registerForm");

         form.addEventListener("submit", function(event) {
             const name = document.getElementById("name");
             const email = document.getElementById("email");
             const phone = document.getElementById("phone");
             const password = document.getElementById("password");
             const confirmPassword = document.getElementById("password_confirmation");

             const errors = [];

             document.querySelectorAll(".text-danger").forEach(el => el.textContent = "");

             if (name.value.trim() === "") {
                 errors.push({
                     field: "name",
                     message: "User Name is required."
                 });
             }

             if (!validateEmail(email.value)) {
                 errors.push({
                     field: "email",
                     message: "Invalid email format."
                 });
             }

             if (!validatePhone(phone.value)) {
                 errors.push({
                     field: "phone",
                     message: "Invalid phone number format."
                 });
             }

             if (password.value.trim().length < 8) {
                 errors.push({
                     field: "password",
                     message: "Password must be at least 8 characters."
                 });
             }

             if (password.value !== confirmPassword.value) {
                 errors.push({
                     field: "password_confirmation",
                     message: "Passwords do not match."
                 });
             }

             if (errors.length > 0) {
                 event.preventDefault();
                 errors.forEach(error => {
                     document.getElementById(error.field).nextElementSibling.textContent = error.message;
                 });
             }
         });

         function validateEmail(email) {
             return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
         }

         function validatePhone(phone) {
             return /^\d{10,15}$/.test(phone);
         }
     });
 </script>