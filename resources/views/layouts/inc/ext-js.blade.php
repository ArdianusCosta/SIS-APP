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

{{-- <script>
    // Ketika tombol fullscreen diklik
// app.js atau layout utama
document.addEventListener('DOMContentLoaded', function () {
    const fullscreenBtn = document.getElementById('fullscreen-btn');

    // klik manual
    fullscreenBtn.addEventListener('click', function (e) {
        e.preventDefault();

        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().then(() => {
                localStorage.setItem('fullscreen', 'true');
            }).catch((err) => {
                console.error("Gagal fullscreen:", err);
            });
        } else {
            document.exitFullscreen();
            localStorage.removeItem('fullscreen');
        }
    });

    // jika sebelumnya fullscreen, infoin user
    if (localStorage.getItem('fullscreen') === 'true') {
        alert('Klik tombol fullscreen lagi untuk kembali ke mode fullscreen.');
    }
});
</script> --}}
