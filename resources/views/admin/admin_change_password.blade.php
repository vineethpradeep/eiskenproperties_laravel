@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-4">
        <div class="card card-profile">
            <div
                class="card-header"
                style="background-image: url('assets/img/blogpost.jpg')">
                <div class="profile-picture">
                    <div class="avatar avatar-xl" style="position: relative;">
                        @if (!empty($profileData->avatar))
                        <img
                            id="avatar"
                            src="{{ asset('upload/admin_images/' . $profileData->avatar) }}"
                            alt="Avatar"
                            class="avatar-img rounded-circle" />
                        @else
                        <div id="initials" class="avatar-title rounded-circle border border-white">
                            {{ strtoupper(substr($profileData->name, 0, 1)) }} <!-- Show first letter of username -->
                        </div>
                        @endif
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="user-profile text-center">
                    <div class="name">{{$profileData->name}}</div>
                    <div class="job">Role is {{$profileData->role}}</div>
                    <div class="desc">Eisken Properties Ltd</div>
                    <div class="social-media">
                        <a
                            class="btn btn-info btn-twitter btn-sm btn-link"
                            href="#">
                            <span class="btn-label just-icon"><i class="icon-social-twitter"></i>
                            </span>
                        </a>
                        <a
                            class="btn btn-primary btn-sm btn-link"
                            rel="publisher"
                            href="#">
                            <span class="btn-label just-icon"><i class="icon-social-facebook"></i>
                            </span>
                        </a>
                        <a
                            class="btn btn-danger btn-sm btn-link"
                            rel="publisher"
                            href="#">
                            <span class="btn-label just-icon"><i class="icon-social-instagram"></i>
                            </span>
                        </a>
                    </div>
                    <div class="view-profile">
                        <a href="#" class="btn btn-secondary w-100">Logout</a>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label"> Email id </label>
                            <p class="form-control-static">{{$profileData->email}}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label"> Phone No. </label>
                                <p class="form-control-static">{{$profileData->phone}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label"> Address </label>
                                <p class="form-control-static">{{$profileData->address}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Change Password</div>
                <form action="{{route('admin.update.password')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input
                                    type="password"
                                    class="form-control @error('old_password') is-invalid @enderror"
                                    id="old_password"
                                    name="old_password" />
                                @error('old_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input
                                    type="password"
                                    class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password"
                                    name="new_password" />
                                @error('new_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="new_password_confirmation"
                                    name="new_password_confirmation" />

                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success" type="submit">Update Password</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection