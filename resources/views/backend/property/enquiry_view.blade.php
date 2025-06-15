@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header align-item">
                <div class="card-title">Enquiry View</div>
            </div>
            <form action="{{ route('property.update.enquiry') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $enquiry->id }}">
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>User Name</th>
                                <td>{{ $enquiry->name ?? 'Null' }}</td>
                            </tr>
                            <tr>
                                <th>Property Address</th>
                                <td class="text-primary">{{ $enquiry->property['address'] }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $enquiry->phone }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $enquiry->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-action">
                    <button
                        class="btn {{ $enquiry->status == 0 ? 'btn-success' : 'btn-danger' }}"
                        type="submit"
                        {{ $enquiry->status == 1 ? 'disabled' : '' }}>
                        {{ $enquiry->status == 1 ? 'Confirmed' : 'Confirm Contact Enquiry' }}
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>


@endsection