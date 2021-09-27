<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@lang('site.name_us')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/src_website/images/nahl0.png') }}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/public/admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Bootstrap 4 RTL -->
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <!-- Custom style for RTL -->
  <link rel="stylesheet" href="{{url('/')}}/public/admin/dist/css/custom.css">


  @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <?php
        $info = DB::table('infos')->first();
       $unActivecourses=\App\Course::where('activate',0)->count();
        $unactiveUser=\App\User::where('s',0)->count();
        $unReadContact=\App\Contact::where('show',1)->count();
        ?>


    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <!-- <span class="badge badge-danger navbar-badge">3</span> -->
        </a>

      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          @if(count(auth::user()->unReadNotifications)>0)
          <!-- <span class="badge badge-warning navbar-badge">{{count(auth::user()->unReadNotifications)}}</span> -->
          @endif
        </a>
        <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
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
        </div> -->
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img width="5%" alt="{{auth::user()->name}}" src="{{url('/')}}/public/{{auth::user()->avatar}}"/>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


        <div class="dropdown-divider"></div>
            <a href="{{ route('Logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt"></i>@lang("site.logout")</a>
                    <form id="logout-form" action="{{ route('Logout-form') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
            <div class="dropdown-divider"></div>
            <a href="{{url('/')}}" class="dropdown-item">
            @lang('site.home')
            </a>
            <div class="dropdown-divider"></div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}/admin" class="brand-link">
      <img src="{{ url('/') }}/public/storage/{{ $info->logo }}" alt="@lang('lang.name_us')" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">@lang('site.name_us')</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('/')}}/public/{{auth::user()->avatar}}" class="img-circle elevation-2" alt="{{auth::user()->name}}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon classes-with font-awesome or any other icon font library -->
            <li class="nav-item ">
                <a href="{{url('/')}}/admin/users" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                @lang('site.users')
                    @if($unactiveUser>0)
                    <span class="right badge badge-danger">{{$unactiveUser}}</span>
                    @endif
                </p>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{url('/')}}/admin/services" class="nav-link">
                <!-- <i class="nav-icon fab fa-leanpub"></i> -->
                <i class="fas fa-tools"></i>
                <p>
                    @lang('site.services')
                </p>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{url('/')}}/admin/courses" class="nav-link">
                <i class="nav-icon fab fa-leanpub"></i>
                <p>
                @lang('site.courses')
                    @if($unActivecourses>0)
                    <span class="right badge badge-danger">{{$unActivecourses}}</span>
                    @endif
                </p>
                </a>
            </li>


            {{--  <li class="nav-item ">
                <a href="{{url('/')}}/admin/questions" class="nav-link">
                <!-- <i class="nav-icon fab fa-leanpub"></i> -->
                <i class="fas fa-tools"></i>
                <p>
                    @lang('site.questions')
                </p>
                </a>
            </li>  --}}

            <li class="nav-item ">
                <a href="{{url('/')}}/admin/teachers" class="nav-link">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                    @lang('site.teachers')
                </p>
                </a>
            </li>

            <li class="nav-item ">
                <a href="{{url('/')}}/admin/exams" class="nav-link">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>
                    @lang('site.exams')
                </p>
                </a>
            </li>

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-address-book"></i>
                    <p>
                        @lang('site.Contact_Us')
                    @if($unReadContact>0)
                        <span class="right badge badge-danger">{{$unReadContact}}</span>
                        @endif
                        <i class="nav-icon right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('/')}}/admin/contactType" class="nav-link">
                    <p>@lang('site.contactType')</p>
                @if($unReadContact>0)
                    <span class="right badge badge-danger">{{$unReadContact}}</span>
                    @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/')}}/admin/contact" class="nav-link">
                    <p>@lang('site.messages')</p>
                    </a>
                </li>
                </ul>
            </li>

        <li class="nav-item ">
        <a href="{{url('/')}}/admin/news" class="nav-link">
            <i class="nav-icon fa fa-newspaper"></i>
            <p>@lang('site.news')</p>
        </a>
        </li>
        <li class="nav-item ">
            <a href="{{url('/')}}/admin/library" class="nav-link">
                <i class="nav-icon fa fa-book"></i>
                <p>@lang('site.library')</p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{url('/')}}/admin/newsEmail" class="nav-link">
                <i class="nav-icon fa fa-newspaper"></i>
                <p>@lang('site.newsEmail')</p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{url('/')}}/admin/said/about/us" class="nav-link">
                <i class="nav-icon fa fa-comments"></i>
                <p>@lang('site.said_about_us')</p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{url('/')}}/admin/terms" class="nav-link">
                <i class="nav-icon fa fa-gavel"></i>
                <p>@lang('site.terms and condition')</p>
            </a>
        </li>

        <li class="nav-item ">
            <a href="{{url('/')}}/admin/faqs" class="nav-link">
                <i class="nav-icon fa fa-question-circle"></i>
                <p>@lang('site.faq')</p>
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{url('/')}}/admin/partners" class="nav-link">
                <i class="nav-icon fas fa-handshake"></i>
                <p>@lang('site.partners')</p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-info-circle"></i>
                <p>
                    @lang('site.site info')
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('/')}}/admin/info/basic" class="nav-link">
                    <p>@lang('site.basic information')</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/')}}/admin/info/social" class="nav-link">
                    <p>@lang('site.social information')</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/')}}/admin/info/pages" class="nav-link">
                    <p>@lang('site.pages information')</p>
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

  @yield('content')
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <!-- <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-rc.1
    </div> -->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{url('/')}}/public/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/')}}/public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 rtl -->
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jQuery -->
<script src="{{url('/')}}/public/admin/plugins/jquery/jquery.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('/')}}/public/admin/plugins/moment/moment.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('/')}}/public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{url('/')}}/public/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('/')}}/public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/public/admin/dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{url('/')}}/public/admin/dist/js/demo.js"></script>

<!-- Admin Swal Alert Bootstrap5 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (\Session::has('alert'))
    <script>
        Swal.fire({
            icon: "{{ \Session::get('alert')['icon'] }}",
            title: "{{ \Session::get('alert')['title'] }}",
            text: "{{ \Session::get('alert')['text'] }}"
        });
    </script>
    @endif
@yield('script')
</body>
</html>
