@extends('admin.admin_dashboard')
@section('admin')

<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="card card-round">
      <div class="card-body pb-0">
        <div class="h1 fw-bold float-end text-primary">+5%</div>
        <h2 class="mb-2">17</h2>
        <p class="text-muted">Users online</p>
        <div class="pull-in sparkline-fix">
          <div id="lineChart"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-8">
    <div class="row">
      <div class="col-sm-6 col-md-6">
        <div class="card p-3 mb-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-info me-3">
              <i class="fas fa-user-check"></i>
            </span>
            <div>
              <h5 class="mb-1">
                <b><a href="#"><small>All Users</small></a></b>
              </h5>
              <small class="text-muted">{{$allUserCount}}</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6">
        <div class="card p-3 mb-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-secondary me-3">
              <i class="fas fa-envelope"></i>
            </span>
            <div>
              <h5 class="mb-1">
                <b><a href="#"><small>Enquiry Received</small></a></b>
              </h5>
              <small class="text-muted">0</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-6">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-secondary me-3">
              <i class="far fa-paper-plane"></i>
            </span>
            <div>
              <h5 class="mb-1">
                <b><a href="#"><small>Scheduled Property Viewings</small></a></b>
              </h5>
              <small class="text-muted">{{$pendingCount}} Pending</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-6">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-success me-3">
              <i class="far fa-check-circle"></i>
            </span>
            <div>
              <h5 class="mb-1">
                <b><a href="#"><small>Viewing Schedule Confirmed</small></a></b>
              </h5>
              <small class="text-muted">{{$acceptedView}} Accepted</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Property Enquiry Summary</div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead class="thead-light">
              <tr>
                <th scope="col">Property Address</th>
                <th scope="col">Enquiry</th>
                <th scope="col">Viewing Requests</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($propertyRequests as $item)
              <tr>
                <td>{{ $item->property->address ?? 'N/A' }}</td>
                <td>0 users</td>
                <td>{{ $item->request_count }} Requested User</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary card-round">
      <div class="card-header">
        <div class="card-head-row">
          <div class="card-title">Today Viewing</div>
          <div class="card-tools">
            <div class="dropdown">
              <button
                class="btn btn-sm btn-label-light dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                Export
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Export PDF</a>
                <a class="dropdown-item" href="#">Export Excel</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-category">
          {{ \Carbon\Carbon::today()->format('d/m/Y') }}
        </div>
      </div>

      <div class="card-body pb-0" style="max-height: 300px; overflow-y: auto;">
        @if(count($todayRequests) > 0)
        @foreach ($todayRequests as $request)
        <span class="badge badge-success">{{ $request['status'] == 1 ? 'Confirmed' : 'Pending' }}</span>
        <a href="{{route('property.view.schedule', ['id' => $request['id']])}}">
          <div class="mb-4 mt-2 border-bottom pb-2">
            <p class="card-category mb-1">
              <strong>Time:</strong> {{ \Carbon\Carbon::parse($request['view_time'])->format('g:i A') }}
            </p>
            <p class="card-category mb-1">
              <strong>Requested by:</strong> {{ $request['name'] }}
            </p>
            <h4 class="card-title mb-1">
              {{ $request['property']['address'] ?? 'No Address Available' }}
            </h4>
          </div>
        </a>
        @endforeach
        @else
        <div class="text-center mt-4">
          <p class="text-muted">No viewing scheduled for today.</p>
        </div>
        @endif
      </div>
    </div>


  </div>
</div>
@endsection