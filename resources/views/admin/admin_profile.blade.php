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
                        @if (!empty($profiledata->avatar))
                        <img
                            id="avatar"
                            src="{{ asset('upload/admin_images/' . $profiledata->avatar) }}"
                            alt="Avatar"
                            class="avatar-img rounded-circle" />
                        @else
                        <div id="initials" class="avatar-title rounded-circle border border-white">
                            {{ strtoupper(substr($profiledata->name, 0, 1)) }} <!-- Show first letter of username -->
                        </div>
                        @endif
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="user-profile text-center">
                    <div class="name">{{$profiledata->name}}</div>
                    <div class="job">Role is {{$profiledata->role}}</div>
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
                            <p class="form-control-static">{{$profiledata->email}}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label"> Phone No. </label>
                                <p class="form-control-static">{{$profiledata->phone}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label"> Address </label>
                                <p class="form-control-static">{{$profiledata->address}}</p>
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
                <div class="card-title">Update Profile</div>
                <form action="{{route('admin.profile.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="username">UserName</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    value="{{$profiledata->username}}"
                                    placeholder="{{$profiledata->username}}" />
                            </div>
                            <div class="form-group">
                                <label for="name">name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    value="{{$profiledata->name}}"
                                    placeholder="{{$profiledata->name}}" />
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{$profiledata->email}}"
                                    placeholder="{{$profiledata->email}}" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    id="phone"
                                    value="{{$profiledata->phone}}"
                                    placeholder="{{$profiledata->phone}}" />
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input
                                    type="text"
                                    name="address"
                                    class="form-control"
                                    id="address"
                                    value="{{$profiledata->address}}"
                                    placeholder="{{$profiledata->address}}" />
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="avatar"
                                    id="image" />
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success" type="submit">Submit</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
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