<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("css/bootstrap-datetimepicker.min.css")}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset("css/ionicons.min.css")}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset("css/AdminLTE.css")}}">
        <link rel="stylesheet" href="{{asset("css/admin-style.css")}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset("css/_all-skins.min.css")}}">
        <!-- Morris chart -->
        {{--<link rel="stylesheet" href="{{asset("css/morris.css")}}">--}} {{--bản đồ--}}
        <!-- jvectormap -->
        {{--<link rel="stylesheet" href="{{asset("css/jquery-jvectormap-1.2.2.css")}}">--}}
        <!-- Date Picker -->
        {{--<link rel="stylesheet" href="{{asset("css/datepicker3.css")}}">--}}
        <!-- Daterange picker -->
        {{--<link rel="stylesheet" href="{{asset("css/daterangepicker.css")}}">--}}
        <!-- bootstrap wysihtml5 - text editor -->
        {{--<link rel="stylesheet" href="{{asset("css/bootstrap3-wysihtml5.min.css")}}">--}}
        @yield('css')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>C</b>TP</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>CTP</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                @include('admin.nav-header')
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            @include('admin.sidebar')
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @include('admin.alertError')
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0
                </div>
                <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            {{--@include('admin.control-sidebar')--}}
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            {{--<div class="control-sidebar-bg"></div>--}}
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3.1.1 -->
        <script src="{{asset("js/jquery-3.1.1.min.js")}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset("js/jquery-ui.min.js")}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset("js/moment.min.js")}}"></script>
        <script src="{{asset("js/bootstrap.js")}}"></script>
        <!-- Morris.js charts -->
        {{--<script src="{{asset("js/raphael-min.js")}}"></script>
        <script src="{{asset("js/morris.min.js")}}"></script>--}}
        <!-- Sparkline -->
        {{--<script src="{{asset("js/jquery.sparkline.min.js")}}"></script>--}}
        <!-- jvectormap -->
        {{--<script src="{{asset("js/jquery-jvectormap-1.2.2.min.js")}}"></script>
        <script src="{{asset("js/jquery-jvectormap-world-mill-en.js")}}"></script>--}} {{--bản đồ--}}
        <!-- jQuery Knob Chart -->
        {{--<script src="{{asset("js/jquery.knob.js")}}"></script>--}}
        <!-- daterangepicker -->
        {{--<script src="{{asset("js/daterangepicker.js")}}"></script>--}}
        <!-- datepicker -->
        {{--<script src="{{asset("js/bootstrap-datepicker.js")}}"></script>--}}
        <!-- Bootstrap WYSIHTML5 --> {{--editer--}}
        {{--<script src="{{asset("js/bootstrap3-wysihtml5.all.min.js")}}"></script>--}}

        <!-- Slimscroll -->
        {{--<script src="{{asset("js/jquery.slimscroll.min.js")}}"></script>--}}
        <!-- FastClick -->
        {{--<script src="{{asset("js/fastclick.min.js")}}"></script>--}}
        <!-- AdminLTE App -->
        <script src="{{asset("js/bootstrap-datetimepicker.min.js")}}"></script>
        <script src="{{asset("js/adminlte.min.js")}}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{--<script src="{{asset("js/dashboard.js")}}"></script>--}} {{--bản đồ--}}
        <!-- AdminLTE for demo purposes -->
        {{--<script src="{{asset("js/demo.js")}}"></script>--}}
        <script src="{{asset("js/helper.js")}}"></script>

        <script type="text/javascript">
            // To make Pace works on Ajax calls
            $(document).ajaxStart(function() { Pace.restart(); });

            // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Set active state on menu element
            var current_url = "{{ Request::url() }}";
            $("ul.sidebar-menu li a").each(function() {
                if ($(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')))
                {
                    $(this).parents('li').addClass('active');
                }
            });
            {{-- Enable deep link to tab --}}
            var activeTab = $('[href="' + location.hash.replace("#", "#tab_") + '"]');
            activeTab && activeTab.tab('show');
            $('.nav-tabs a').on('shown.bs.tab', function (e) {
                location.hash = e.target.hash.replace("#tab_", "#");
            });
        </script>
        @yield('scripts')
    </body>
</html>
