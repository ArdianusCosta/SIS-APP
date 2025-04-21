@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-2 mx-3" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show mt-2 mx-3" role="alert">
    <strong>Gagal!</strong> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif