<!-- jQuery -->
<script src="{{url('/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/admin/dist/js/demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>

<script>
  //untuk search  
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarSearchForm = document.querySelector('[data-widget="sidebar-search"]');
    const input = sidebarSearchForm.querySelector('input');
  
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault(); 
      }
    });
  });

  //untuk barChart
  document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'Data Konsultasi',
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>