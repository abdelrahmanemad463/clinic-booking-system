  <style>
    .notification-item {
      width: 250px;
      white-space: normal !important;
      line-height: 1.4;
  }
  .notification-item div {
      display: flex;
      align-items: flex-start;
      gap: 8px;
  }
  </style>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    @if (!empty(Auth::check()))

    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header">{{ auth()->user()->unreadNotifications->count() }} Notifications</span>


          @foreach(auth()->user()->unreadNotifications()->latest()->take(5)->get() as $notification)
              <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item notification-item">
                  <div>
                      <i class="fas fa-envelope mr-2"></i>
                      {{ $notification->data['content'] }}
                  </div>
              </a>
          @endforeach
         
          
          <div class="dropdown-divider"></div>
          <a href="{{ url('user/notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('user/read-all-notifications') }}" class="dropdown-item dropdown-footer">Read All Notifications</a>
        </div>
      </li>

      <li class="nav-item">
        <a href="{{ url('logout') }}" class="nav-link">
          <p>Sign Out</p>
        </a>
      </li>
    @else
      <li class="nav-item">
        <a href="{{ url('login') }}" class="nav-link">
          <p>Sign In</p>
        </a>
      </li>
    @endif
    
  </ul>

  </nav>
  <!-- /.navbar -->

    <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align:center;">
      <span class="brand-text font-weight-light" style="font-weight:bold !important;font-size:20px;">Clinic Appointament</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ !empty(Auth::check()) ? Auth::user()->name : 'Guest' }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

            <li class="nav-header" style="text-align: center;">USER</li>

          <li class="nav-item">
            <a href="{{ url('user/avaiable_doctors/list') }}" class="nav-link @if(Request::segment(2) == 'avaiable_doctors') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Available Doctors
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Available Clinics
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('user/my_appointaments/list?created_date_from=') . date('Y-m-d') }}" class="nav-link @if(Request::segment(2) == 'my_appointaments') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>My Appointaments</p>
            </a>
          </li>

            <li class="nav-header" style="text-align: center;">ADMIN</li>

          <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'users') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/clinics/list') }}" class="nav-link @if(Request::segment(2) == 'clinics') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Clinics
              </p>
            </a>
          </li>
          

          <!-- <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Assign Doctors
              </p>
            </a>
          </li> -->
          
          <li class="nav-item">
            <a href="{{ url('admin/assign/list') }}" class="nav-link @if(Request::segment(2) == 'assign') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Assign Doctor To Clinic
              </p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Assign Assistant
              </p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="{{ url('admin/set_doctor_appointaments') }}" class="nav-link @if(Request::segment(2) == 'set_doctor_appointaments') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p style="font-size: 15px;">
               Set Doctor Appointaments
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>Pending Appointaments</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>All Appointaments</p>
            </a>
          </li>

            <li class="nav-header" style="text-align: center;">DOCTOR</li>

          <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p style="font-size: 14px;">Set Available Appointaments</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('doctor/doctor_appointaments/list?created_date_from=').date('Y-m-d') }}" class="nav-link @if(Request::segment(2) == 'doctor_appointaments') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>My Appointaments</p>
            </a>
          </li>

            <li class="nav-header" style="text-align: center;">ASSISTANT</li>

          <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>Appointaments</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/users/list') }}" class="nav-link @if(Request::segment(2) == 'user') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>Accepted Appointaments</p>
            </a>
          </li>

            <li class="nav-header" style="text-align: center;">Settings</li>

          <li class="nav-item">
            <a href="{{ url('panel/setting') }}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                SETTINGS
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
