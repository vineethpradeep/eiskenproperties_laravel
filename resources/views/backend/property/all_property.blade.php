@extends('admin.admin_dashboard')
@section('admin')
<div class="row mt-8">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Property</h4>
                    <a
                        class="btn btn-primary btn-round ms-auto" href="{{route('add.property')}}">
                        <i class="fa fa-plus"></i>
                        Add Property
                    </a>
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
                                <th>Name</th>
                                <th>Images</th>
                                <th>Code</th>
                                <th>Status Type</th>
                                <th>City</th>
                                <th>P-Type</th>
                                <th>Rent</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($properties as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->property_name }}</td>
                                <td>
                                    <img src="{{ asset($item->property_thumbnail ?: 'https://bbxtbqstyfhfjybywyya.supabase.co/storage/v1/object/public/uploads/default-image/default_multi_image.jpg' ) }}" alt="{{ $item->property_name }}" style="width: 60px; height: 40px">
                                </td>
                                <td>{{ $item->property_code }}</td>
                                <td>
                                    {{ $item->property_status}}
                                </td>
                                <td>{{ $item->city }}</td>
                                <td>{{ $item['propertyType']['property_type_name'] }}</td>
                                <td>{{ $item->rent }}</td>

                                <td>{{ $item->property_code }}</td>
                                <td>@if($item->status == 1) <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif</td>
                                <td class="text-nowrap">
                                    <a href="{{route('details.property', $item->id)}}"
                                        class="btn btn-secondary" title="Property Details"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('edit.property', $item->id)}}"
                                        class="btn btn-info" title="Edit Property"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('delete.property', $item->id)}}"
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