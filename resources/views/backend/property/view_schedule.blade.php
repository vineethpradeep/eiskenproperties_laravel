@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header align-item">
                <div class="card-title">Request Schedule</div>
            </div>
            <form action="{{ route('property.update.schedule') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $schedule->id }}">
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>User Name</th>
                                <td>{{ $schedule->user['name'] ?? 'Null' }}</td>
                            </tr>
                            <tr>
                                <th>Property Address</th>
                                <td class="text-primary">{{ $schedule->property['address'] }}</td>
                            </tr>
                            <tr>
                                <th>Viewing User Name</th>
                                <td>{{ $schedule->name }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $schedule->phone }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $schedule->email }}</td>
                            </tr>

                            <tr>
                                <th>Viewing Date</th>
                                <td>{{ $schedule->view_date }}</td>
                            </tr>
                            <tr>
                                <th>Viewing Time</th>
                                <td>{{ $schedule->view_time }}</td>
                            </tr>
                            <tr>
                                <th>Message</th>
                                <td>{{ $schedule->message }}</td>
                            </tr>
                            <tr>
                                <th>Requested Date</th>
                                <td>{{ $schedule->created_at->format('d-m-Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-action">
                    <button
                        class="btn {{ $schedule->status == 0 ? 'btn-success' : 'btn-danger' }}"
                        type="submit"
                        {{ $schedule->status == 1 ? 'disabled' : '' }}>
                        {{ $schedule->status == 1 ? 'Confirmed' : 'Confirm Schedule' }}
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>


@endsection