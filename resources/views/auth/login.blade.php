<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - SIS-APP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="/img/logo-SIS.jpg">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #121212;
      color: #f1f1f1;
    }

    .full-page {
      height: 100vh;
      display: flex;
    }

    .left-panel {
      background-color: #1e1e1e;
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-end;
      padding-bottom: 2rem;
    }

    .left-panel img {
      max-width: 95%;
      height: auto;
    }

    .right-panel {
      flex: 1;
      background-color: #121212;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      padding: 3rem;
    }

    .right-panel h4 {
      font-weight: bold;
      margin-bottom: 1rem;
      position: relative;
      display: inline-block;
      color: #f1f1f1;
    }

    .right-panel h4::after {
      content: '';
      display: block;
      width: 50px;
      height: 4px;
      background-color: #ff7f00;
      margin: 8px auto 0;
      border-radius: 2px;
    }

    .form-label {
      text-transform: lowercase;
      color: #dddddd;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #444;
      background-color: #1e1e1e;
      color: #f1f1f1;
      padding: 0.75rem 1rem;
    }

    .form-control::placeholder {
      color: #aaaaaa;
    }

    .form-check-label {
      color: #cccccc;
      font-size: 0.9rem;
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 0.9rem;
      margin-top: 0.5rem;
      margin-bottom: 1.2rem;
    }

    .form-options a {
      color: #ffa94d;
      text-decoration: underline;
    }

    .btn-login {
      background-color: #2c2c2c;
      color: #ffffff;
      font-weight: bold;
      border: 1px solid #444;
      border-radius: 10px;
      padding: 0.7rem;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background-color: #444;
    }

    .btn-google-login {
      background-color: #ffffff;
      color: #010101;
      font-weight: 500;
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 0.7rem;
      text-decoration: none;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-google-login:hover {
      background-color: #444;
      box-shadow: 0 2px 6px rgba(255, 255, 255, 0.1);
      text-decoration: none;
    }

    .google-icon {
      width: 20px;
      height: 20px;
    }

    .alert-danger {
      background-color: #ff4d4d;
      border: none;
      color: #fff;
    }

    .footer {
      font-size: 13px;
      margin-top: 2rem;
      color: #888;
      opacity: 0.9;
    }

    @media (max-width: 768px) {
      .full-page {
        flex-direction: column;
      }

      .left-panel, .right-panel {
        flex: none;
        width: 100%;
        height: auto;
        padding: 2rem 1rem;
      }

      .right-panel {
        align-items: stretch;
      }

      .left-panel {
        align-items: center;
        padding-bottom: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="full-page">
    <div class="left-panel">
      <img src="{{ asset('img/login1.png') }}" alt="Login Illustration">
    </div>

    <div class="right-panel">
      <h4 class="text-center">Selamat Datang di <strong>SIS-APP!</strong></h4>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('loginSukses') }}" method="POST" style="width: 100%; max-width: 400px;">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required autofocus placeholder="Masukkan email...">
        </div>
        <div class="mb-2">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required placeholder="Masukkan password...">
        </div>

        <div class="form-options">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Ingatkan Saya</label>
          </div>
          <a href="#">Lupa Password?</a>
        </div>

        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-login">Login</button>
        </div>

        <div class="d-grid mb-2">
          <a href="{{ url('auth/google') }}" class="btn btn-google-login">
            <img src="/img/login-google.png" alt="Google" class="google-icon">
            <span>Login dengan Google</span>
          </a>
        </div>
      </form>

      <p class="footer text-center">&copy; {{ date('Y') }} SIS-APP</p>
    </div>
  </div>
</body>
</html>
