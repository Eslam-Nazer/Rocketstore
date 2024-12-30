<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ !empty($header_title) ? $header_title : ''}} - RocketStore</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{url('assest/css/fontawesome/css/all.min.css')}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('assest/css/adminlte.min.css')}}">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.layouts.header')
        @yield('content')
        @include('admin.layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{url('assest/js/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{url('assest/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{url('assest/js/dist/adminlte.js')}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{url('assest/js/chart.js/Chart.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{url('assest/js/dist/demo.js')}}"></script> -->
    @yield('script')
</body>

</html>
