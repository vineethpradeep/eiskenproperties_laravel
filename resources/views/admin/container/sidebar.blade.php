<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="/admin/dashboard" class="logo">
        <img
          src="{{asset('assets/img/logo.svg')}}"
          alt="navbar brand"
          class="navbar-brand"
          height="28" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item active">
          <a href="/admin/dashboard">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Property Management</h4>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#propertyMenu">
            <i class="fas fa-layer-group"></i>
            <p>Properties</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="propertyMenu">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('all.property')}}">
                  <span class="sub-item">All Property</span>
                </a>
              </li>
              <li>
                <a href="{{route('add.property')}}">
                  <span class="sub-item">Add Property</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sidebarLayouts">
            <i class="fas fa-th-list"></i>
            <p>Property Type</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="sidebarLayouts">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('all.property_type')}}">
                  <span class="sub-item">All Propeertie Type</span>
                </a>
              </li>
              <li>
                <a href="{{route('add.property_type')}}">
                  <span class="sub-item">Add Propertie Type</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#forms">
            <i class="fas fa-pen-square"></i>
            <p>Add Amenities</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="forms">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('all.amenitie')}}">
                  <span class="sub-item">All Amenitie</span>
                </a>
              </li>
              <li>
                <a href="{{route('add.amenitie')}}">
                  <span class="sub-item">Add Amenitie</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#userList">
            <i class="fas fa-th-list"></i>
            <p>User</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="userList">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('all.users')}}">
                  <span class="sub-item">All User</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{route('schedule.request')}}">
            <i class="fas fa-calendar"></i>
            <p>Schedule Request</p>
            <span class="badge badge-success">{{$pendingCount}}</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('schedule.request')}}">
            <i class="fas fa-calendar"></i>
            <p>Enquiry</p>
            <span class="badge badge-secondary">0</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>