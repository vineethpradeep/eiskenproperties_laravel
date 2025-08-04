@extends('admin.admin_dashboard')
@section('admin')
<div class="row mt-8">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Property Features</h4>
                    <a
                        class="btn btn-primary btn-round ms-auto" href="{{route('add.feature')}}">
                        <i class="fa fa-plus"></i>
                        Add Feature
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
                                <th>Feature Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($features as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->feature_name }}</td>
                                <td>
                                    <a href="{{route('edit.feature', $item->id)}}"
                                        class="btn btn-info" title="Edit Feature"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('delete.feature', $item->id)}}"
                                        class="btn btn-danger" id="delete" title="Delete Feature"><i class="fa fa-trash"></i></a>
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