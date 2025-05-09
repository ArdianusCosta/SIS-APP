<!-- jQuery -->
<script src="{{url('/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/admin/dist/js/demo.js')}}"></script>
<script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarSearchForm = document.querySelector('[data-widget="sidebar-search"]');
      const input = sidebarSearchForm.querySelector('input');
  
      input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
          e.preventDefault(); // cegah submit form
        }
      });
    });
  </script>