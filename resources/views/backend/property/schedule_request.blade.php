@extends('admin.admin_dashboard')
@section('admin')
<div class="row mt-8">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Scheduled Requests</h4>
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
                                <th>Property Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($requestView as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item['property']['property_name'] }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->view_date }}</td>
                                <td>{{ $item->view_time }}</td>
                                <td>
                                    @if($item->status == 1)
                                    <span class="badge badge-success">Confirmed</span>
                                    @else
                                    <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('property.view.schedule', $item->id)}}"
                                        class="btn btn-secondary" title="View Request Details"><i class="fa fa-eye"></i></a>
                                    <a href="#"
                                        class="btn btn-danger" id="delete" title="Delete Request"><i class="fa fa-trash"></i></a>
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