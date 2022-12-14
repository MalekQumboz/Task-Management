<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Task-Management | @yield('page-title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('Task-Management/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Task-Management/dist/css/adminlte.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('Task-Management/plugins/toastr/toastr.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Task-Management/dist/css/adminlte.min.css')}}">
  @yield('style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('Task-Management.dashboard')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('Task-Management/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('Task-Management/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('Task-Management/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('Task-Management/dist/img/hotel.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Task Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image"> 
          <img src="{{asset('Task-Management/dist/img/user.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->userName}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Home</li>    
          <li class="nav-item">
            <a href="{{route('Task-Management.dashboard')}}" class="nav-link ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
               

          
          @canany(['Create-Employee', 'Read-Employees', 'Update-Employee','Delete-Employee',
          'Create-Attendance', 'Read-Attendances', 'Update-Attendance','Delete-Attendance'])
          <li class="nav-header">Human Resources</li>

          @canany(['Create-Employee', 'Read-Employees', 'Update-Employee','Delete-Employee'])
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Employees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              @canany([ 'Read-Employees', 'Update-Employee','Delete-Employee'])
              <li class="nav-item">
                <a href="{{route('employees.index')}}" class="nav-link ">
                  <i class=" fas fa-users nav-icon"></i>
                  <p>Index</p>
                </a>
              </li>
              @endcanany

              @can('Create-Employee')
              <li class="nav-item">
                <a href="{{route('employees.create')}}" class="nav-link ">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              @endcan

            </ul>
          </li>
          @endcanany

          @canany(['Create-Attendance', 'Read-Attendances', 'Update-Attendance','Delete-Attendance'])
          <li class="nav-item">
            <a href="{{route('attendances.index')}}" class="nav-link ">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              
              <li class="nav-item">
                <a href="{{route('attendances.index')}}" class="nav-link ">
                  <i class=" fas fa-address-book nav-icon"></i>
                  <p>Index</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendances.create')}}" class="nav-link ">
                  <i class="far fa-edit nav-icon"></i>
                  <p>sign up</p>
                </a>
              </li>
            </ul>
          </li>
          @endcanany
          @endcanany

          @canany(['Create-Project', 'Read-Projects', 'Update-Project','Delete-Project',
          'Create-Task', 'Read-Tasks', 'Update-Task','Delete-Task'])
          <li class="nav-header">Content Mangement</li>

          @canany(['Create-Project', 'Read-Projects', 'Update-Project','Delete-Project'])
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-hotel"></i>
              <p>
                Projects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">

              @canany([ 'Read-Projects', 'Update-Project','Delete-Project'])
              <li class="nav-item">
                <a href="{{route('projects.index')}}" class="nav-link ">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Index</p>
                </a>
              </li>
              @endcanany

              @can('Create-Project')
              <li class="nav-item">
                <a href="{{route('projects.create')}}" class="nav-link ">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany

          @canany(['Create-Task', 'Read-Tasks', 'Update-Task','Delete-Task'])
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Tasks
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              
              @canany([ 'Read-Tasks', 'Update-Task','Delete-Task'])
              <li class="nav-item">
                <a href="{{route('tasks.index')}}" class="nav-link ">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Index</p>
                </a>
              </li>
              @endcanany

              @can('Create-Task')
              <li class="nav-item">
                <a href="{{route('tasks.create')}}" class="nav-link ">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany

          @endcanany

          @canany(['Read-Roles', 'Create-Role', 'Update-Role','Delete-Role','Read-Permission'])
          <li class="nav-header">Role & Permission</li>

          @canany(['Read-Roles', 'Create-Role', 'Update-Role','Delete-Role'])
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-user-tag"></i>
              <p>
                Role
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">

              @canany(['Read-Roles', 'Update-Role','Delete-Role'])
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Index</p>
                </a>
              </li>
              @endcanany

              @can('Create-Role')
              <li class="nav-item">
                <a href="{{route('roles.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create </p>
                </a>
              </li>
              @endcan
              
            </ul>
          </li>
          @endcanany

          @can('Read-Permission')
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-id-badge"></i>
              <p>
                Permission
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{route('permissions.index')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Index</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @endcanany

          <li class="nav-header">Setting</li>
          <li class="nav-item">
            <a href="{{route('Task-Management.edit-password')}}" class="nav-link ">
              <i class="fas fa-lock"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('logout')}}" class="nav-link ">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('big-title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('Task-Management.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">@yield('sm-title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    {{-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div> --}}
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="#">Task Management</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('Task-Management/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('Task-Management/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('Task-Management/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('js/axios.js')}}"></script>
<script src="{{asset('js/sweetalert.js')}}"></script>
<script src="{{asset('Task-Management/plugins/toastr/toastr.min.js')}}"></script>
@yield('script')
</body>
</html>
