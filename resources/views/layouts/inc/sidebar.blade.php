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
            @php $user = Auth::user(); @endphp
            <img src="{{ $user && $user->photo ? asset('storage/' . $user->photo) : '/admin/dist/img/user4-128x128.jpg' }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('profile.index')}}" class="d-block">{{Auth()->user()->name}}</a>
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('welcome')}}" class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">              
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @auth
            @if (auth()->user()->role === 'admin')
            <li class="nav-header">Halaman Akun</li>
            <li class="nav-item">
              <a href="{{route('user.index')}}" class="nav-link {{request()->routeIs('user.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Pengguna
                </p>
              </a>
            </li>
            @endif
          @endauth

          @auth
              @if (in_array(auth()->user()->role, ['admin','guru']))
                <li class="nav-header">Halaman Manajement</li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sitemap"></i>
                    <p>
                      Manajement
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="../layout/top-nav.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manajement Akademik</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('guru.index')}}" class="nav-link {{request()->routeIs('guru.index') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manajement Guru</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('siswa.index')}}" class="nav-link {{request()->routeIs('siswa.index') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manajement Siswa</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('kelas.index')}}" class="nav-link {{request()->routeIs('kelas.index') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manajement Kelas</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{route('ortu.index')}}" class="nav-link {{request()->routeIs('ortu.index') ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manajement Orang Tua</p>
                      </a>
                    </li>
                  </ul>
                </li>
          @endif
          @endauth

          @auth
              @if (in_array(auth()->user()->role, ['admin','guru',]))
                <li class="nav-header">Halaman Absensi</li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-clipboard-check"></i>
                    <p>
                      Absensi
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="../charts/chartjs.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Absensi Scan</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../charts/flot.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Absensi Input</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../charts/inline.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekap Harian & Bulanan</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../charts/uplot.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Export Laporan</p>
                      </a>
                    </li>
                  </ul>
                </li>
            @endif
          @endauth

          <li class="nav-header">Informasi & Penggumuman</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Informasi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penggumuman</p>
                </a>
              </li>
              @auth
                @if (in_array(auth()->user()->role, ['admin','guru']))
                  <li class="nav-item">
                    <a href="{{route('email.create')}}" class="nav-link {{request()->routeIs('email.create') ? 'active' : ''}}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Kirim ke Pengguna</p>
                    </a>
                  </li>
                @endif
              @endauth
        </ul>
        <li class="nav-item mt-5">
          <a href="{{route('auth.logout')}}" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>