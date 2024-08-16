<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diamond-Aviratinfo</title>
    <link rel="icon" href="{{ asset('img/avirattablogo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/purchase-report.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/purchase.css?v=' . time()) }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <style>

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
    <div class="wrapper">

        <!-- Navbar -->
        @include('navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
            <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
                <div class="nav-item dropdown">
                    <a class="nav-link bg-#0B5D70 dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">Close</a>
                    <div class="dropdown-menu mt-0">
                        <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Close All</a>
                        <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Close
                            All Other</a>
                    </div>
                </div>
                <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i
                        class="fas fa-angle-double-left nav-icon"></i></a>
                <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
                <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i
                        class="fas fa-angle-double-right nav-icon"></i></a>
                <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i
                        class="fas fa-expand nav-icon"></i></a>
            </div>
            <div class="tab-content">

                @yield('content')

                <div class="tab-empty" style="position: relative;display: flex;justify-content: center;-ms-flex-align: center;align-items: center;">
                    {{-- @include('dasboard') --}}
                   <h2 class="display-4">Welcome</h2>
                </div>
                <div class="tab-loading">
                    <div>
                        <img style="width:60px;" src='{{ asset('img/diamond.gif') }}'>
                        {{-- <h2 class="display-4">loading <i class="fa fa-sync fa-spin"></i></h2> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
     <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js?v='.time()) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- AdminLTE for demo purposes -->
</body>
</html>
