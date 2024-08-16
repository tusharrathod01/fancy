<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="icon" href="{{asset('img/avirattablogo.png')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('css/purchase-report.css?v='.time()); }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css'); }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('css/purchase.css?v='.time()); }}">

  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css'); }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css'); }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'); }}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css'); }}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css'); }}">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap4.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('css/button/dataTables.bootstrap4.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('css/button/responsive.bootstrap4.min.css'); }}">
  <link rel="stylesheet" href="{{ asset('css/button/buttons.bootstrap4.min.css'); }}">
  {{-- <link rel="stylesheet" href="{{ asset('css/tabulator.min.css'); }}"> --}}
  <link href="{{ asset('css/tabulator5_6.css?v=' . time()) }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css'); }}">
  <title>Diamond-Aviratinfo</title>

</head>
<body>


 @yield('content')


 <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js'); }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js'); }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js'); }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js'); }}"></script>
<!-- InputMask -->
<script src="{{ asset('plugins/moment/moment.min.js'); }}"></script>
<script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js'); }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js'); }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'); }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); }}"></script> -->
<!-- BS-Stepper -->
<script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js'); }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('plugins/dropzone/min/dropzone.min.js'); }}"></script>
<script src="{{ asset('js/jquery.form.js'); }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js'); }}"></script>

@stack("script")
</body>
</html>
