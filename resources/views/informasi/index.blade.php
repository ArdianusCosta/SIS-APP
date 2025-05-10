@extends('layouts.main')

@section('content-header')
<div class="container-fluid">
  <div class="row mb-2 align-items-center">
    <div class="col-sm-6">
      <h1 class="m-0">Informasi & Pengumuman</h1>
    </div>
    <div class="col-sm-6 text-sm-right">
      <a href="{{ route('informasi.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Buat Informasi</a>
    </div>
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
      <div class="col-12 col-md-6 col-lg-4 mb-4 announcement-item" data-category="{{ Str::slug($informasi->kategori) }}">
        <div class="card h-100 shadow-sm bg-gradient-dark rounded-lg overflow-hidden">
          @php
            $isImage = $informasi->lampiran && Str::startsWith(mime_content_type(storage_path('app/public/' . $informasi->lampiran)), 'image/');
          @endphp
          <div class="card-img-wrapper">
            <img 
              src="{{ $isImage ? asset('storage/' . $informasi->lampiran) : '/admin/dist/img/default-info.jpg' }}" 
              class="card-img-top" 
              alt="Gambar {{ $informasi->judul }}"
              style="height: 200px; object-fit: cover;"
            >
          </div>
          <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
            <h5 class="card-title text-white mb-2">{{ $informasi->judul }}</h5>
            <span class="badge mb-2 {{ match($informasi->kategori) {
                'Pengumuman' => 'badge-primary',
                'Jadwal Acara' => 'badge-info',
                'Kegiatan Akademik' => 'badge-success',
                'Ekstrakurikuler' => 'badge-warning',
                'Organisasi Sekolah' => 'badge-secondary',
                'Pelayanan' => 'badge-danger',
                default => 'badge-dark'
            } }}">{{ $informasi->kategori }}</span>
            <p class="card-text text-white mb-2" style="font-size: 0.9rem;">
              {{ Str::limit(strip_tags($informasi->isi), 100) }}
            </p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-white">{{ \Carbon\Carbon::parse($informasi->tanggal)->format('d M Y') }}</small>
              <button 
                type="button" 
                class="btn btn-sm btn-primary" 
                data-toggle="modal" 
                data-target="#infoModal{{ $informasi->id }}"
                aria-label="Lihat detail {{ $informasi->judul }}"
              >
                <i class="fas fa-info-circle"></i> Lihat Detail
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="infoModal{{ $informasi->id }}" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel{{ $informasi->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content rounded-lg">
            <div class="modal-header border-0">
              <h5 class="modal-title" id="infoModalLabel{{ $informasi->id }}">{{ $informasi->judul }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="text-center mb-4">
                <img 
                  src="{{ $isImage ? asset('storage/' . $informasi->lampiran) : '/admin/dist/img/default-info.jpg' }}" 
                  alt="Gambar {{ $informasi->judul }}" 
                  class="img-fluid rounded border" 
                  style="max-height: 300px; width: auto; object-fit: cover;"
                >
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Kategori:</strong> {{ $informasi->kategori }}</li>
                <li class="list-group-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($informasi->tanggal)->format('d M Y') }}</li>
                <li class="list-group-item"><strong>Isi:</strong> 
                  <div class="mt-2">{!! $informasi->isi !!}</div>
                </li>
                @if ($informasi->lampiran)
                <li class="list-group-item">
                  <strong>Lampiran:</strong>
                  @php
                    $extension = pathinfo($informasi->lampiran, PATHINFO_EXTENSION);
                    $icon = match($extension) {
                        'pdf' => 'fas fa-file-pdf',
                        'doc', 'docx' => 'fas fa-file-word',
                        'jpg', 'jpeg', 'png' => 'fas fa-file-image',
                        'xls', 'xlsx' => 'fas fa-file-excel',
                        'ppt', 'pptx' => 'fas fa-file-powerpoint',
                        'zip' => 'fas fa-file-archive',
                        default => 'fas fa-file',
                    };
                  @endphp
                  <a href="{{ asset('storage/' . $informasi->lampiran) }}" download class="btn btn-sm btn-outline-secondary">
                    <i class="{{ $icon }}"></i> Unduh Lampiran
                  </a>
                </li>
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

    <div class="mt-4">
      {{ $informasis->links() }}
    </div>
  </div>
</div>

<style>
.card.card-solid {
  transform: none !important;
  box-shadow: none !important;
  transition: none !important;
}
.announcement-item .card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  position: relative;
  z-index: 1;
}
.announcement-item .card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.2) !important;
  z-index: 2;
}
.card-img-wrapper {
  overflow: hidden;
  position: relative;
}
.card-img-top {
  transition: transform 0.3s ease;
}
.announcement-item .card:hover .card-img-top {
  transform: scale(1.05);
}
.card-img-overlay {
  background: linear-gradient(0deg, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
  transition: background 0.3s ease;
}
.announcement-item .card:hover .card-img-overlay {
  background: linear-gradient(0deg, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
}
.badge {
  font-size: 0.75rem;
  padding: 0.4em 0.7em;
  border-radius: 0.25rem;
}
.nav-tabs .nav-link {
  border-radius: 0.25rem;
  margin-right: 5px;
  transition: background-color 0.3s ease;
}
.nav-tabs .nav-link:hover, .nav-tabs .nav-link.active {
  background-color: #e9ecef;
}
.modal-content {
  background: #fff !important;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
.modal-backdrop {
  opacity: 0.3 !important;
}
.input-group-text {
  background-color: #f8f9fa;
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
