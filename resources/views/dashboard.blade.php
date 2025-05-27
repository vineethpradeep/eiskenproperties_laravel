      @extends('frontend.frontend-landingpage')

      @section('header')
      @include('frontend.home.breadcrumb')
      @endsection

      @section('main')
      <!-- Profile to Action Start -->


      <div class="container-xxl py-5">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4">
                      <div class="bg-white widget-form border rounded">
                          <h3 class="h4 text-black mb-3">User Profile</h3>
                          <div class="d-flex">
                              @php

                              $userId = Auth::user()->id;
                              $userdata = \App\Models\User::find($userId);

                              @endphp

                              @if (!empty($userdata->avatar))
                              <img
                                  class="img-fluid flex-shrink-0"
                                  src="{{ asset('upload/user_images/' . $userdata->avatar) }}"
                                  style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;" />
                              @else
                              <span
                                  class="bg-dark rounded-circle d-flex justify-content-center align-items-center"
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
                                  <h3 class="h4 text-black mb-3">Hi {{ Auth::user()->name }}, your Dashboard</h3>
                                  <div class="d-flex propery-info">
                                      <ul>
                                          <li>
                                              <i class="fa-regular fa-clock me-2"></i>April 15, 2023
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          @include('frontend.property.partials.properties_info')
                          <div class="row no-gutters mt-5">
                              <div class="col-12">
                                  <h2 class="h4 text-black mb-3">Activity Log</h2>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Profile to Action End -->
      @endsection