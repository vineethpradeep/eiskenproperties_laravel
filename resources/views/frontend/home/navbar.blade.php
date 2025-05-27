    <div class="container-fluid nav-bar bg-transparent">
        <nav
            class="navbar navbar-expand-lg bg-dark navbar-light py-0 px-4 custom-navbar">
            <div class="logo p-2 me-2">
                <a
                    href="{{url('/')}}"
                    class="navbar-brand d-flex align-items-center text-center">
                    <img src="{{asset('/frontend/assets/img/logo.png')}}" alt="Icon" />
                </a>
            </div>

            <button
                type="button"
                class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
                    <a href="{{url('/about')}}" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Property</a>
                        <div class="dropdown-menu rounded m-0">
                            <a href="{{ route('all.property.list') }}" class="dropdown-item">Property List</a>
                            <a href="#" class="dropdown-item">Property Agreements</a>
                        </div>
                    </div>
                    <a href="{{url('/contact')}}" class="nav-item nav-link">Contact</a>
                </div>

                @auth
                <li class="nav-item dropdown ms-3 list-unstyled">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        @if (!empty(Auth::user()->avatar))
                        <img
                            src="{{ asset('upload/user_images/' . Auth::user()->avatar) }}"
                            alt="Avatar"
                            style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;" />
                        @else
                        <span
                            class="bg-dark rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 45px; height: 45px;">
                            <span class="text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu custom-left-dropdown m-0">
                        <li><span class="dropdown-item">{{ Auth::user()->name }}</span></li>
                        <li><a href="{{route('dashboard')}}" class="dropdown-item">Profile Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="{{route('user.logout')}}" class="dropdown-item">
                                Logout
                            </a>
                        </li>
                        <form id="logout-form" action="/logout" method="POST" class="d-none">@csrf</form>
                    </ul>
                </li>
                @else
                <li class="nav-item list-unstyled">
                    <a href="{{route('login')}}" class="btn btn-primary px-3 d-none d-lg-flex">Sign In</a>
                </li>
                @endauth
            </div>


        </nav>
    </div>