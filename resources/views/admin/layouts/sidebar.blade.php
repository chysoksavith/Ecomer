  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('admin/images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">EcoShop</span>
      </a>


      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  @if (!empty(Auth::guard('admin')->user()->image))
                      <img src="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}"
                          class="img-circle elevation-2" alt="User Image">
                  @else
                      <img src="{{ asset('admin/images/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
                  @endif
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  @if (Session::get('page') == 'dashboard')
                      @php
                          $active = 'active';
                      @endphp
                  @else
                      @php
                          $active = '';
                      @endphp
                  @endif
                  <li class="nav-item">
                      <a href="{{ route('admin.index') }}" class="nav-link {{ $active }}">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  {{-- setting --}}
                  @if (Session::get('page') == 'update-password' || Session::get('page') == 'update-detail')
                      @php
                          $active = 'active';
                      @endphp
                  @else
                      @php
                          $active = '';
                      @endphp
                  @endif
                  <li class="nav-item">
                      <a href="#" class="nav-link {{ $active }}">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Setting
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              @if (Session::get('page') == 'update-password')
                                  @php
                                      $active = 'active';
                                  @endphp
                              @else
                                  @php
                                      $active = '';
                                  @endphp
                              @endif
                              <a href="{{ route('admin.update.password') }}" class="nav-link {{ $active }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Update Admin Pass</p>
                              </a>
                              @if (Session::get('page') == 'update-detail')
                                  @php
                                      $active = 'active';
                                  @endphp
                              @else
                                  @php
                                      $active = '';
                                  @endphp
                              @endif
                              <a href="{{ route('admin.update.adminDetails') }}" class="nav-link {{ $active }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Update Admin Details</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- cms page --}}
                  @if (Session::get('page') == 'cms-pages')
                      @php
                          $active = 'active';
                      @endphp
                  @else
                      @php
                          $active = '';
                      @endphp
                  @endif
                  <li class="nav-item">
                      <a href="{{route('admin.cmspages')}}" class="nav-link {{ $active }}">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Cms Pages
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Charts
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/charts/chartjs.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>ChartJS</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/charts/flot.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Flot</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/charts/inline.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Inline</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/charts/uplot.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>uPlot</p>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
