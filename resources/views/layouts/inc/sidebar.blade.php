<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="https://github.com/ArdianusCosta" class="brand-link">
    <img src="/admin/dist/img/logo-SIS.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SIS-APP</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @php $user = auth()->user(); @endphp
        <img src="{{ $user && $user->photo ? asset('storage/' . $user->photo) : '/admin/dist/img/user4-128x128.jpg' }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ $user ? route('profile.index') : '#' }}" class="d-block">{{ $user ? $user->name : 'Guest' }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('welcome')}}" class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        @auth
          @php $user = auth()->user(); @endphp

          @if ($user->role === 'admin')
            <li class="nav-header">Halaman Akun</li>
            <li class="nav-item">
              <a href="{{route('user.index')}}" class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Pengguna</p>
              </a>
            </li>
          @endif

          @php $manajemenRoutes = ['guru.index', 'siswa.index', 'kelas.index', 'ortu.index']; @endphp
          @if (in_array($user->role, ['admin','guru']))
            <li class="nav-header">Halaman Manajement</li>
            <li class="nav-item {{ in_array(Route::currentRouteName(), $manajemenRoutes) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $manajemenRoutes) ? 'active' : '' }}">
                <i class="nav-icon fas fa-sitemap"></i>
                <p>Manajement<i class="fas fa-angle-left right"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manajement Akademik</p>
                  </a>
                </li>
                @if ($user->role === 'admin')
                <li class="nav-item">
                  <a href="{{route('guru.index')}}" class="nav-link {{ request()->routeIs('guru.index') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manajement Guru</p>
                  </a>
                </li>
                @endif
                <li class="nav-item">
                  <a href="{{route('siswa.index')}}" class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manajement Siswa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('kelas.index')}}" class="nav-link {{ request()->routeIs('kelas.index') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manajement Kelas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ortu.index')}}" class="nav-link {{ request()->routeIs('ortu.index') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manajement Orang Tua</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif

          @php $absensiRoutes = ['index-scan', 'scan-kamera', 'absensi-input.create']; @endphp
          @if (in_array($user->role, ['admin','guru']))
            <li class="nav-header">Halaman Absensi</li>
            <li class="nav-item {{ in_array(Route::currentRouteName(), $absensiRoutes) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $absensiRoutes) ? 'active' : '' }}">
                <i class="nav-icon fa fa-calendar"></i>
                <p>Absensi<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('index-scan') }}" class="nav-link {{ request()->routeIs('index-scan') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Absensi Generate QR</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('scan-kamera') }}" class="nav-link {{ request()->routeIs('scan-kamera') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Absensi Scan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('absensi-input.create') }}" class="nav-link {{ request()->routeIs('absensi-input.create') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Absensi Input</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif

          @php $aktivitasRoutes = ['surat.index']; @endphp
          @if (in_array($user->role, ['admin','guru','murid']))
            <li class="nav-header">Halaman Aktivitas</li>
            <li class="nav-item {{ in_array(Route::currentRouteName(), $aktivitasRoutes) ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $aktivitasRoutes) ? 'active' : '' }}">
                <i class="nav-icon fa fa-file"></i>
                <p>Aktivitas<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('surat.index')}}" class="nav-link {{ request()->routeIs('surat.index') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Aktivitas Surat Izin</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif
        @endauth

        <li class="nav-header">Informasi & Penggumuman</li>
        @php $informasiRoutes = ['kontak-guru', 'email.create']; @endphp
        <li class="nav-item {{ in_array(Route::currentRouteName(), $informasiRoutes) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), $informasiRoutes) ? 'active' : '' }}">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>Informasi<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('informasi.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Info & Penggumuman</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('kontak-guru') }}" class="nav-link {{ request()->routeIs('kontak-guru') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Info Kontak Guru</p>
              </a>
            </li>
            @auth
              @if (in_array(auth()->user()->role, ['admin','guru']))
              <li class="nav-item">
                <a href="{{ route('email.create') }}" class="nav-link {{ request()->routeIs('email.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kirim ke Pengguna</p>
                </a>
              </li>
              @endif
            @endauth
          </ul>
        </li>

        <li class="nav-item mt-5">
          <a href="{{ route('auth.logout') }}" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<script>
  document.body.addEventListener('click', function (e) {
    const el = e.target.closest('.sidebar-search-results .list-group-item');
    if (el) {
      e.preventDefault();
      let href = el.getAttribute('href');
      if (href.startsWith(window.location.origin)) {
        window.location.href = href;
      } else {
        try {
          href = decodeURIComponent(href);
        } catch (e) {}
        window.location.href = href;
      }
    }
  });
</script>