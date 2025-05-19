<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Reset Password - SIS-APP</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      background-color: #f4f4f4;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      background-color: #ffffff;
      padding: 30px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .btn {
      display: inline-block;
      padding: 12px 20px;
      margin-top: 20px;
      background-color: #f97316;
      color: #ffffff;
      text-decoration: none;
      border-radius: 5px;
    }
    .footer {
      font-size: 12px;
      color: #888;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Permintaan Reset Password</h2>
    <p>Halo,</p>
    <p>Kami menerima permintaan untuk mereset password akun Anda di <strong>SIS-APP</strong>.</p>
    <p>Silakan klik tombol di bawah ini untuk melanjutkan proses reset password Anda:</p>

    <a href="{{ $link }}" class="btn">Reset Password</a>

    <p>Jika Anda tidak merasa melakukan permintaan ini, Anda dapat mengabaikan email ini. Tidak ada tindakan lebih lanjut yang diperlukan.</p>

    <p>Terima kasih,<br>Tim SIS-APP</p>

    <div class="footer">
      Email ini dikirim secara otomatis, mohon untuk tidak membalas.
    </div>
  </div>
</body>
</html>
