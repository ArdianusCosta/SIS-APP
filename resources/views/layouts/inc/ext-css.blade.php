  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/admin/dist/css/adminlte.min.css')}}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="icon" href="/img/logo-SIS.jpg">

  <style>
    .pagination {
      display: inline-flex;
      justify-content: center;
      flex-wrap: wrap;
    }
    
    .pagination li {
      display: inline;
      margin: 0 2px;
    }
  
    .pagination-wrapper {
      text-align: center;
    }

    .profile-user-img {
      width: 128px; 
      height: 128px; 
      border-radius: 50%; 
      object-fit: cover;
  }

    .image {
    width: 40px;
    height: 40px;
    aspect-ratio: 1 / 1;
    overflow: hidden;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ccc; 
  }

    .profile-sidebar-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .user-panel {
      padding-left: 10px;
      padding-right: 10px;
    }

    .user-panel .image {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      overflow: hidden;
      position: relative;
      flex-shrink: 0;
      background-color: #ccc;
    }

    .user-panel .image img {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      transform: translate(-50%, -50%);
      object-fit: cover;
    }

    .user-panel .info {
      margin-left: 10px;
      display: flex;
      align-items: center;
    }
  
    .preloader {
    background-color: #343a40;
    height: 100vh;
    width: 100vw;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }

    .preloader img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
  }
  
  </style>
  
  