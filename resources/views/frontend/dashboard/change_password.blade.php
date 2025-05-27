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
                                 <h3 class="h4 text-black mb-3">Change Password</h3>
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
                                 <form action="{{route('user.update.password')}}" method="POST" enctype="multipart/form-data">
                                     @csrf
                                     <div class="row g-3">
                                         <div class="col-md-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="password"
                                                     class="form-control"
                                                     id="old_password"
                                                     placeholder="User Name"
                                                     name="old_password"
                                                     autocomplete="off" />
                                                 <label for="old_password">Old Password</label>
                                                 @error('old_password')
                                                 <span class="text-danger">{{$message}}</span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="col-md-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="password"
                                                     class="form-control"
                                                     id="new_password"
                                                     placeholder="New Password"
                                                     name="new_password"
                                                     autocomplete="off" />
                                                 <label for="new_password">New Password</label>
                                                 @error('new_password')
                                                 <span class="text-danger">{{$message}}</span>
                                                 @enderror
                                             </div>
                                         </div>
                                         <div class="col-md-12">
                                             <div class="form-floating">
                                                 <input
                                                     type="password"
                                                     class="form-control"
                                                     id="new_password_confirmation"
                                                     placeholder="Confirm Password"
                                                     name="new_password_confirmation"
                                                     autocomplete="off" />
                                                 <label for="new_password_confirmation">Confirm Password</label>

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
     @endsection