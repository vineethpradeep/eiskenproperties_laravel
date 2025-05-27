@extends('admin.admin_dashboard')
@section('admin')
<div class="row mt-8">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Property Type</h4>
                    <a
                        class="btn btn-primary btn-round ms-auto" href="{{route('add.property_type')}}">
                        <i class="fa fa-plus"></i>
                        Add Property Type
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
                                <th>Property Type Name</th>
                                <th>Icon</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($types as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->property_type_name }}</td>
                                <td>{{ $item->property_icon }}</td>
                                <td>
                                    <a href="{{route('edit.property_type', $item->id)}}"
                                        class="btn btn-info" title="Edit Property type"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('delete.property_type', $item->id)}}"
                                        class="btn btn-danger" id="delete" title="Delete property type"><i class="fa fa-trash"></i></a>
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