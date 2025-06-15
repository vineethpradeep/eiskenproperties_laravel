 <div class="main-header">
     <div class="main-header-logo">
         <!-- Logo Header -->
         <div class="logo-header" data-background-color="dark">
             <a href="index.html" class="logo">
                 <img
                     src="{{asset('assets/img/logo.svg')}}"
                     alt="navbar brand"
                     class="navbar-brand"
                     height="20" />
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
     <!-- Navbar Header -->
     <nav
         class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
         <div class="container-fluid">
             <nav
                 class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                 <div class="input-group">
                     <div class="input-group-prepend">
                         <button type="submit" class="btn btn-search pe-1">
                             <i class="fa fa-search search-icon"></i>
                         </button>
                     </div>
                     <input
                         type="text"
                         placeholder="Search ..."
                         class="form-control" />
                 </div>
             </nav>

             <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                 <li
                     class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                     <a
                         class="nav-link dropdown-toggle"
                         data-bs-toggle="dropdown"
                         href="#"
                         role="button"
                         aria-expanded="false"
                         aria-haspopup="true">
                         <i class="fa fa-search"></i>
                     </a>
                     <ul class="dropdown-menu dropdown-search animated fadeIn">
                         <form class="navbar-left navbar-form nav-search">
                             <div class="input-group">
                                 <input
                                     type="text"
                                     placeholder="Search ..."
                                     class="form-control" />
                             </div>
                         </form>
                     </ul>
                 </li>
                 <li class="nav-item topbar-icon dropdown hidden-caret">
                     <a
                         class="nav-link dropdown-toggle"
                         href="#"
                         id="messageDropdown"
                         role="button"
                         data-bs-toggle="dropdown"
                         aria-haspopup="true"
                         aria-expanded="false">
                         <i class="fa fa-envelope"></i>
                     </a>
                     <ul
                         class="dropdown-menu messages-notif-box animated fadeIn"
                         aria-labelledby="messageDropdown">
                         <li>
                             <div
                                 class="dropdown-title d-flex justify-content-between align-items-center">
                                 Messages
                                 <a href="#" class="small">Mark all as read</a>
                             </div>
                         </li>
                         <li>
                             <div class="message-notif-scroll scrollbar-outer">
                                 <div class="notif-center">
                                     <a href="#">
                                         <div class="notif-img">
                                             <img
                                                 src="{{asset('assets/img/jm_denis.jpg')}}"
                                                 alt="Img Profile" />
                                         </div>
                                         <div class="notif-content">
                                             <span class="subject">Jimmy Denis</span>
                                             <span class="block"> How are you ? </span>
                                             <span class="time">5 minutes ago</span>
                                         </div>
                                     </a>
                                 </div>
                             </div>
                         </li>
                         <li>
                             <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item topbar-icon dropdown hidden-caret">
                     <a
                         class="nav-link dropdown-toggle"
                         href="#"
                         id="notifDropdown"
                         role="button"
                         data-bs-toggle="dropdown"
                         aria-haspopup="true"
                         aria-expanded="false">
                         <i class="fa fa-bell"></i>
                         @if(isset($totalCount) && $totalCount > 0)
                         <span class="notification">{{$totalCount}} </span>
                         @endif
                     </a>
                     <ul
                         class="dropdown-menu notif-box animated fadeIn"
                         aria-labelledby="notifDropdown">
                         <li>
                             <div class="dropdown-title">
                                 You have {{ $totalCount > 0 ? $totalCount : 0 }} new notification
                             </div>
                         </li>
                         <li>
                             <div class="notif-scroll scrollbar-outer">
                                 <div class="notif-center">
                                     @foreach($activeUsers as $user)
                                     <a href="{{route('all.users')}}">
                                         <div class="notif-icon notif-primary">
                                             <i class="fa fa-user"></i>
                                         </div>
                                         <div class="notif-content">
                                             <span class="block">
                                                 Active user: <strong>{{ $user->name }}</strong>
                                             </span>
                                             <span class="time">
                                                 {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                             </span>
                                         </div>
                                     </a>
                                     @endforeach
                                     @foreach ($requestView as $request)
                                     @if($request->status == 0)
                                     <a href="{{route('schedule.request')}}">
                                         <div class="notif-icon notif-success">
                                             <i class="fa fa-calendar"></i>
                                         </div>
                                         <div class="notif-content">
                                             <span class="block">
                                                 {{ $request->name }} requested a viewing
                                             </span>
                                             <span class="time">
                                                 {{ \Carbon\Carbon::parse($request->created_at)->diffForHumans() }}
                                             </span>
                                         </div>
                                     </a>
                                     @endif
                                     @endforeach
                                 </div>
                             </div>
                         </li>
                         <li>
                             <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @php
                 use Illuminate\Support\Facades\Auth;

                 $userId = Auth::user()->id;
                 $userdata = \App\Models\User::find($userId);

                 @endphp
                 <li class="nav-item topbar-user dropdown hidden-caret">
                     <a
                         class="dropdown-toggle profile-pic"
                         data-bs-toggle="dropdown"
                         href="#"
                         aria-expanded="false">

                         <div class="avatar-sm">
                             @if (!empty($userdata->avatar))
                             <img
                                 id="avatar"
                                 src="{{ asset('upload/admin_images/' . $userdata->avatar) }}"
                                 alt="Avatar"
                                 class="avatar-img rounded-circle" />
                             @else
                             <div id="initials" class="avatar-title rounded-circle border border-white">
                                 {{ strtoupper(substr($userdata->name, 0, 1)) }} <!-- Show first letter of username -->
                             </div>
                             @endif
                             <!-- <img
                                 src="{{asset('assets/img/profile.jpg')}}"
                                 alt="..."
                                 class="avatar-img rounded-circle" /> -->
                         </div>
                         <span class="profile-username">
                             <span class="op-7">Hi,</span>
                             <span class="fw-bold">{{$userdata->name}}</span>
                         </span>
                     </a>
                     <ul class="dropdown-menu dropdown-user animated fadeIn">
                         <div class="dropdown-user-scroll scrollbar-outer">
                             <li>
                                 <div class="user-box">
                                     <div class="avatar-lg">
                                         @if (!empty($userdata->avatar))
                                         <img
                                             id="avatar"
                                             src="{{ asset('upload/admin_images/' . $userdata->avatar) }}"
                                             alt="Avatar"
                                             class="avatar-img rounded" />
                                         @else
                                         <div id="initials" class="avatar-title rounded border border-white">
                                             {{ strtoupper(substr($userdata->name, 0, 1)) }} <!-- Show first letter of username -->
                                         </div>
                                         @endif
                                         <!-- <img
                                             src="{{asset('assets/img/profile.jpg')}}"
                                             alt="image profile"
                                             class="avatar-img rounded" /> -->
                                     </div>
                                     <div class="u-text">
                                         <h4>{{$userdata->name}}</h4>
                                         <p class="text-muted">{{$userdata->email}}</p>
                                         <a
                                             href="{{url('/')}}"
                                             class="btn btn-xs btn-secondary btn-sm">Go to Home Page</a>
                                     </div>
                                 </div>
                             </li>
                             <li>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="{{route('admin.profile')}}">My Profile</a>
                                 <a class="dropdown-item" href="{{route('admin.change.password')}}">Change Password</a>
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="{{route('admin.logout')}}">Logout</a>
                             </li>
                         </div>
                     </ul>
                 </li>
             </ul>
         </div>
     </nav>
     <!-- End Navbar -->
 </div>