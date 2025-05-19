<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - SIS-APP</title>
  <link rel="icon" href="/img/logo-SIS.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('/img/bg-loginn.jpeg');">
  <div class="backdrop-blur-md bg-black/50 p-8 rounded-2xl shadow-xl w-full max-w-md text-white">
    <img src="/img/logo-SIS.jpg" alt="SIS-APP Logo" class="w-24 h-24 rounded-full border-4 border-white mx-auto mb-6">

    @if ($errors->any())
      <div class="bg-red-500 text-white text-sm rounded-lg p-4 mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('error'))
      <div class="bg-red-500 text-white text-sm rounded-lg p-4 mb-4">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('loginSukses') }}" method="POST">
      @csrf
      <div class="mb-4">
        <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-3 rounded-xl bg-transparent border border-white/30 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
      </div>
      <div class="mb-4 relative">
        <input type="password" name="password" id="password" placeholder="Password" required class="w-full px-4 py-3 rounded-xl bg-transparent border border-white/30 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400">
        <i class="bi bi-eye absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-300" id="togglePassword" onclick="togglePassword()"></i>
      </div>

      <div class="flex items-center justify-between text-sm mb-4">
        <label class="flex items-center">
          <input type="checkbox" class="form-checkbox text-orange-400 mr-2">Remember me
        </label>
        <a href="#" class="text-orange-400 underline">Forgot password?</a>
      </div>

      <button type="submit" class="w-full py-2 bg-orange-300 text-black font-semibold rounded-xl hover:bg-orange-400 transition duration-300">Login</button>

      <a href="{{ url('auth/google') }}" class="w-full mt-4 py-2 bg-white text-black font-medium rounded-xl flex justify-center items-center gap-2 hover:bg-gray-200 transition duration-300">
        <img src="/img/login-google.png" class="w-5 h-5" alt="Google">Login dengan Google
      </a>
    </form>
  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById("password");
      const icon = document.getElementById("togglePassword");
      const isVisible = password.type === "text";

      password.type = isVisible ? "password" : "text";
      icon.classList.toggle("bi-eye");
      icon.classList.toggle("bi-eye-slash");
    }
  </script>
</body>
</html>