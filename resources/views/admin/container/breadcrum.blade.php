                  <div class="page-header">
                      <!-- <h3 class="fw-bold mb-3">Admin</h3> -->
                      <ul class="breadcrumbs">
                          <li class="nav-home">
                              <a href="{{ url('/admin/dashboard') }}">
                                  <i class="icon-home"></i>
                              </a>
                          </li>
                          <li class="separator">
                              <i class="icon-arrow-right"></i>
                          </li>
                          @foreach($breadcrumbs as $key => $crumb)
                          @if($key === array_key_last($breadcrumbs))
                          <li class="breadcrumb-item active" aria-current="page">{{ $crumb }}</li>
                          @else
                          <li class="breadcrumb-item">{{ $crumb }}</li>
                          @endif
                          @endforeach
                      </ul>
                  </div>