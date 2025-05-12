@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2 align-items-center">
      <div class="col-sm-6">
        <h1 class="m-0">Informasi & Pengumuman</h1>
      </div>
      @auth
        @if (in_array(auth()->user()->role, ['admin','guru']))
          <div class="col-sm-6 text-sm-right">
            <a href="{{ route('informasi.create') }}" class="btn btn-success">Buat Informasi</a>
          </div>
        @endif
      @endauth
    </div>
  </div>
@endsection

@section('content')
@include('layouts.inc.alert')

<div class="card card-solid">
  <div class="card-body">

    <ul class="nav nav-tabs mb-4" id="filterTabs">
      <li class="nav-item">
        <a class="nav-link active" href="#" data-filter="all"><i class="fas fa-list"></i> Semua</a>
      </li>
      @foreach (['Pengumuman', 'Jadwal Acara', 'Kegiatan Akademik', 'Ekstrakurikuler', 'Organisasi Sekolah', 'Pelayanan'] as $kategori)
        <li class="nav-item">
          <a class="nav-link" href="#" data-filter="{{ Str::slug($kategori) }}">
            <i class="{{ match($kategori) {
              'Pengumuman' => 'fas fa-bullhorn',
              'Jadwal Acara' => 'fas fa-calendar-alt',
              'Kegiatan Akademik' => 'fas fa-book',
              'Ekstrakurikuler' => 'fas fa-futbol',
              'Organisasi Sekolah' => 'fas fa-users',
              'Pelayanan' => 'fas fa-hands-helping',
              default => 'fas fa-info-circle'
            } }}"></i> {{ $kategori }}
          </a>
        </li>
      @endforeach
    </ul>

    <div class="mb-4">
      <div class="input-group">
        <input type="text" class="form-control" id="searchInput" placeholder="Cari informasi..." aria-label="Cari informasi">
        <div class="input-group-append">
          <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
      </div>
    </div>

    <div class="row" id="announcementList">
      @forelse ($informasis as $informasi)
        @php
          $imageExts = ['jpg', 'jpeg', 'png', 'svg'];
          $fotoUrl = '/admin/dist/img/default-info.jpg';

          if ($informasi->foto) {
            $fotoUrl = asset('storage/' . $informasi->foto);
          } elseif ($informasi->lampiran && in_array(strtolower(pathinfo($informasi->lampiran, PATHINFO_EXTENSION)), $imageExts)) {
            $fotoUrl = asset('storage/' . $informasi->lampiran);
          }
        @endphp

        <div class="col-12 col-md-6 col-lg-4 mb-4 announcement-item" data-category="{{ Str::slug($informasi->kategori) }}">
          <div class="card h-100 shadow-sm rounded-lg overflow-hidden text-white border-0"
               style="background: url('{{ $fotoUrl }}') center center / cover no-repeat;">
            <div class="card-img-overlay d-flex flex-column justify-content-end p-3" style="background: rgba(0,0,0,0.5);">
              <h5 class="card-title mb-2 text-center">{{ $informasi->judul }}</h5>
              <span class="badge mb-2 {{ match($informasi->kategori) {
                'Pengumuman' => 'badge-primary',
                'Jadwal Acara' => 'badge-info',
                'Kegiatan Akademik' => 'badge-success',
                'Ekstrakurikuler' => 'badge-warning',
                'Organisasi Sekolah' => 'badge-secondary',
                'Pelayanan' => 'badge-danger',
                default => 'badge-dark'
              } }}">{{ $informasi->kategori }}</span>
              <p class="card-text mb-2" style="font-size: 0.9rem;">
                {{ Str::limit(strip_tags($informasi->isi), 100) }}
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <small>{{ \Carbon\Carbon::parse($informasi->tanggal)->format('d M Y') }}</small>
                <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#infoModal{{ $informasi->id }}">
                  <i class="fas fa-info-circle"></i> Lihat Detail
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="infoModal{{ $informasi->id }}" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel{{ $informasi->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content rounded-lg overflow-hidden">

              @if ($informasi->foto)
                <div class="position-relative" style="height: 300px; background: url('{{ asset('storage/' . $informasi->foto) }}') center center / cover no-repeat;">
                  <a href="{{ asset('storage/' . $informasi->foto) }}" target="_blank" class="position-absolute text-white" style="top: 10px; right: 10px; background: rgba(0,0,0,0.5); padding: 6px 10px; border-radius: 4px;">
                    <i class="fas fa-search-plus"></i> Lihat Gambar
                  </a>
                </div>
              @endif

              <div class="modal-header border-0">
                <h5 class="modal-title">{{ $informasi->judul }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="list-group list-group-flush mb-3">
                  <li class="list-group-item"><strong>Kategori:</strong> {{ $informasi->kategori }}</li>
                  <li class="list-group-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($informasi->tanggal)->format('d M Y') }}</li>
                  <li class="list-group-item"><strong>Isi:</strong> <div class="mt-2">{!! $informasi->isi !!}</div></li>

                  @if ($informasi->lampiran)
                    @php
                      $ext = strtolower(pathinfo($informasi->lampiran, PATHINFO_EXTENSION));
                      $isImage = in_array($ext, $imageExts);
                    @endphp

                    @unless($isImage)
                      @php
                        $icon = match($ext) {
                          'pdf' => 'fas fa-file-pdf',
                          'doc', 'docx' => 'fas fa-file-word',
                          'xls', 'xlsx' => 'fas fa-file-excel',
                          'ppt', 'pptx' => 'fas fa-file-powerpoint',
                          'zip' => 'fas fa-file-archive',
                          default => 'fas fa-file'
                        };
                      @endphp
                      <li class="list-group-item">
                        <strong>Lampiran:</strong>
                        <a href="{{ asset('storage/' . $informasi->lampiran) }}" target="_blank" class="btn btn-outline-primary btn-sm mr-2">
                          <i class="{{ $icon }}"></i> Lihat
                        </a>
                        <a href="{{ asset('storage/' . $informasi->lampiran) }}" download class="btn btn-outline-secondary btn-sm">
                          <i class="fas fa-download"></i> Unduh
                        </a>
                      </li>
                    @endunless
                  @endif
                </ul>
              </div>
              <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </div>

            </div>
          </div>
        </div>

      @empty
        <div class="col-12 text-center py-5">
          <p class="text-muted">Belum ada informasi tersedia.</p>
        </div>
      @endforelse
    </div>
  </div>
</div>

<style>
.card.card-solid {
  border: none !important;
}
.announcement-item .card {
  min-height: 300px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.announcement-item .card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.3);
}
.nav-tabs .nav-link:hover, .nav-tabs .nav-link.active {
  background-color: #e9ecef;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput');
  const announcementItems = document.querySelectorAll('.announcement-item');
  const navLinks = document.querySelectorAll('#filterTabs .nav-link');
  let activeFilter = 'all';

  function filterItems() {
    const keyword = searchInput.value.toLowerCase();
    announcementItems.forEach(item => {
      const title = item.querySelector('.card-title').textContent.toLowerCase();
      const category = item.getAttribute('data-category');
      const matchesFilter = activeFilter === 'all' || category === activeFilter;
      const matchesSearch = title.includes(keyword);
      item.classList.toggle('d-none', !(matchesFilter && matchesSearch));
    });
  }

  navLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      activeFilter = this.getAttribute('data-filter');
      navLinks.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
      filterItems();
    });
  });

  searchInput.addEventListener('input', filterItems);
});
</script>
@endsection
