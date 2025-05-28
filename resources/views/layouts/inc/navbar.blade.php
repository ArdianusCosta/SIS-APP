<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="/admin/dist/img/logo-SIS.jpg" alt="SIS-APP_Logo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('welcome')}}" class="nav-link  {{ request()->routeIs('welcome') ? 'active' : '' }}">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('contact-to-speedseat.index')}}" class="nav-link {{request()->routeIs('contact-to-speedseat.index') ? 'active' : ''}}">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/admin/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/admin/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
      </li>
      
      <!-- Notifications Dropdown Menu -->
      @auth
          @if (in_array(auth()->user()->role, ['admin']))
          <style>
            .dropdown-menu {
              min-width: 300px;
              border-radius: 0.5rem;
              padding: 0.5rem;
              font-size: 14px;
            }
            .dropdown-item {
              white-space: normal;
            }
          </style>  
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              @if($unreadCount > 0)
                <span class="badge badge-warning navbar-badge">{{ $unreadCount }}</span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow">
              <span class="dropdown-item text-center font-weight-bold">{{ $notifications->count() }} Notifikasi Terbaru</span>
              <div class="dropdown-divider"></div>
          
              @foreach($notifications as $notif)
              <a href="{{ route('ppdb-notifikasi.baca', $notif->id) }}" class="dropdown-item {{ $notif->is_read ? 'text-muted' : '' }}">
                <i class="fas fa-user-plus mr-2"></i> {{ $notif->message }}
                  <span class="float-right text-muted text-sm">{{ $notif->created_at->diffForHumans() }}</span>
                </a>
                <div class="dropdown-divider"></div>
              @endforeach
          
              <a href="#" class="dropdown-item text-center text-primary font-weight-bold">
                Lihat Semua Notifikasi
              </a>
            </div>
          </li>

          <script>
            let previousUnreadCount = {{ $unreadCount ?? 0 }};
        
            function checkForNewNotifications() {
                fetch("{{ route('api.get-unread-count') }}")
                    .then(res => res.json())
                    .then(data => {
                        const currentCount = data.unreadCount;
                        if (currentCount > previousUnreadCount) {
                            document.getElementById('notifSound').play();
                        }
                        previousUnreadCount = currentCount;
                    });
            }
        
            setInterval(checkForNewNotifications, 15000); // tiap 15 detik cek
        </script>
        

          @endif
      @endauth      

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->