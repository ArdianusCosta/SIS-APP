<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password - SIS-APP</title>
  <link rel="icon" href="/img/logo-SIS.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('/img/bg-loginn.jpeg');">
  <div class="backdrop-blur-md bg-black/50 p-8 rounded-2xl shadow-xl w-full max-w-md text-white">
    <img src="/img/logo-SIS.jpg" alt="SIS-APP Logo" class="w-24 h-24 rounded-full border-4 border-white mx-auto mb-6">

    <h2 class="text-center text-xl font-semibold mb-4">Reset Password</h2>

    @if ($errors->any())
      <div class="bg-red-500 text-white text-sm rounded-lg p-4 mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <input type="hidden" name="email" value="{{ $email }}">

      <div class="mb-4 relative">
        <input type="password" name="password" id="password" placeholder="Password" required class="w-full px-4 py-3 rounded-xl bg-transparent border border-white/30 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
        <button type="button" onclick="togglePassword('password', 'togglePasswordIcon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 focus:outline-none">
          <i class="bi bi-eye" id="togglePasswordIcon"></i>
        </button>
      </div>

      <div class="mb-6 relative">
        <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Konfirmasi password" required class="w-full px-4 py-3 rounded-xl bg-transparent border border-white/30 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
        <button type="button" onclick="togglePassword('confirmPassword', 'toggleConfirmIcon')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 focus:outline-none">
          <i class="bi bi-eye" id="toggleConfirmIcon"></i>
        </button>
      </div>

      <button type="submit" class="w-full py-2 bg-orange-300 text-black font-semibold rounded-xl hover:bg-orange-400 transition duration-300">
        Reset Password
      </button>
    </form>

    <div class="text-center mt-6">
      <a href="{{ route('auth.login') }}" class="text-orange-400 underline text-sm">Kembali ke Login</a>
    </div>
  </div>

  <script>
    function togglePassword(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      const isVisible = input.type === "text";
  
      input.type = isVisible ? "password" : "text";
      icon.classList.toggle("bi-eye");
      icon.classList.toggle("bi-eye-slash");
    }
  </script>
</body>
</html>
