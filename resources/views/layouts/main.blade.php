
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIS-APP {{isset($title) ? ' | '.$title : '' }}</title>

@include('layouts.inc.ext-css')
@stack('css')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  @include('layouts.inc.navbar')

@include('layouts.inc.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @yield('content-header')
    </section>

    <!-- Main content -->
    <section class="content">
      <audio id="notifSound" src="{{ asset('sounds/notif.mp3') }}" preload="auto"></audio>
     @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('layouts.inc.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@stack('scripts')
@include('layouts.inc.ext-js')
@stack('js')
</body>
</html>
