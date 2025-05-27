@extends('admin.admin_dashboard')
@section('admin')
<div class="row mt-8">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">All User</h4>
                    <!-- <a
                        class="btn btn-primary btn-round ms-auto" href="{{route('add.property')}}">
                        <i class="fa fa-plus"></i>
                        Add Property
                    </a> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        id="basic-datatables"
                        class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Avatar</th>
                                <th>User Name</th>
                                <th>Email Id</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="avatar-sm">
                                        @if (!empty($user->avatar))
                                        <img
                                            id="avatar"
                                            src="{{ asset('upload/admin_images/' . $user->avatar) }}"
                                            alt="Avatar"
                                            class="avatar-img rounded-circle" />
                                        @else
                                        <div id="initials" class="avatar-title rounded-circle border border-white">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->phone}}
                                </td>
                                <td>{{ $user->address }}</td>
                                <td>@if($user->status == "active") <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif</td>
                                <td>
                                    <a href="{{route('details.property', $user->id)}}"
                                        class="btn btn-secondary" title="Property Details"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('delete.property', $user->id)}}"
                                        class="btn btn-danger" id="delete" title="Delete Property"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection