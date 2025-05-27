     @extends('frontend.frontend-landingpage')

     @section('header')
     @include('frontend.home.breadcrumb')
     @endsection

     @section('main')
     <!-- Profile to Action Start -->
     <div class="container-xxl py-5">
         @php

         $userId = Auth::user()->id;
         $userdata = \App\Models\User::find($userId);

         @endphp

         <div class="container">
             <div class="row">
                 <div class="col-lg-4">
                     <div class="bg-white widget-form border rounded">
                         <h3 class="h4 text-black mb-3">User Profile</h3>
                         <div class="d-flex">
                             @if (!empty($userdata->avatar))
                             <img
                                 class="img-fluid flex-shrink-0"
                                 id="avatar"
                                 alt="Avatar"
                                 src="{{ asset('upload/user_images/' . $userdata->avatar) }}"
                                 style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;" />
                             @else
                             <span
                                 class="bg-dark rounded-circle d-flex justify-content-center align-items-center" id="initials"
                                 style="width: 55px; height: 55px"><span class="text-white agent-name">{{ strtoupper(substr($userdata->name, 0, 1)) }}</span></span>
                             @endif

                             <div class="ps-3">
                                 <h6 class="fw-bold mb-1">{{$userdata->name}}</h6>
                                 <small>{{$userdata->email}}</small>
                             </div>
                         </div>
                     </div>

                     @include('frontend.dashboard.sidebar')
                 </div>
                 <div class="col-lg-8">
                     <div
                         class="bg-white property-body border-bottom border-left border-right border-top">
                         <div class="row">
                             <div class="col-md-12">
                                 <h3 class="h4 text-black mb-3">Edit Profile</h3>
                                 <div class="d-flex propery-info">
                                     <ul>
                                         <li>
                                             <i class="fa-regular fa-clock me-2"></i>April 15, 2023
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                         <div class="row no-gutters">
                             <div class="col-12">
                                 <form action="{{route('user.profile.store')}}" method="POST" enctype="multipart/form-data">
                                     @csrf
                                     <div class="row g-3">
                                         <div class="col-md-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="text"
                                                     class="form-control"
                                                     id="username"
                                                     placeholder="User Name"
                                                     name="username"
                                                     value="{{$userdata->username}}"
                                                     autocomplete="off" />
                                                 <label for="name">User Name</label>
                                             </div>
                                         </div>
                                         <div class="col-md-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="text"
                                                     class="form-control"
                                                     id="name"
                                                     placeholder="Name"
                                                     name="name"
                                                     value="{{$userdata->name}}"
                                                     autocomplete="off" />
                                                 <label for="name">Name</label>
                                             </div>
                                         </div>
                                         <div class="col-md-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="email"
                                                     class="form-control"
                                                     id="email"
                                                     name="email"
                                                     placeholder="Email"
                                                     value="{{$userdata->email}}"
                                                     autocomplete="off" />
                                                 <label for="email">Email</label>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="phone"
                                                     class="form-control"
                                                     id="phone"
                                                     name="phone"
                                                     placeholder="Phone Number"
                                                     value="{{$userdata->phone}}"
                                                     autocomplete="off" />
                                                 <label for="phone">Phone Number</label>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="text"
                                                     class="form-control"
                                                     id="address"
                                                     name="address"
                                                     placeholder="Address"
                                                     value="{{$userdata->address}}"
                                                     autocomplete="off" />
                                                 <label for="address">Address</label>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="file"
                                                     class="form-control"
                                                     id="image"
                                                     name="avatar"
                                                     placeholder="Upload Avatar"
                                                     autocomplete="off" />
                                                 <label for="avatar">Upload Avatar</label>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <button
                                                 class="btn btn-primary w-100 py-3"
                                                 type="submit">
                                                 Save Changes
                                             </button>
                                         </div>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Profile to Action End -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script>
         $(document).ready(function() {
             $('#image').change(function(e) {
                 let reader = new FileReader();
                 reader.onload = (e) => {
                     // Always update the visible image
                     $('#avatar, #showImage').attr('src', e.target.result).show();
                     // Also hide initials if visible
                     $('#initials').hide();
                 }
                 reader.readAsDataURL(e.target.files[0]);
             });
         });
     </script>
     @endsection