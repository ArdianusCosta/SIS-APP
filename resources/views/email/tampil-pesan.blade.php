<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesan Baru dari {{ $nama_pengirim }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .email-container {
      background-color: #ffffff;
      max-width: 600px;
      margin: 40px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .header {
      background-color: #2C2C2C;
      padding: 15px;
      color: #ffffff;
      text-align: center;
      border-radius: 10px 10px 0 0;
    }

    .content {
      padding: 20px;
      color: #333333;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      color: #777777;
      padding: 10px;
      margin-top: 20px;
    }

    .btn {
      background-color: #ffffff;
      color: #ffffff;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
    }

    .message-box {
      background: #f9f9f9;
      padding: 15px;
      border-left: 4px solid #0d00ff;
      margin-top: 10px;
      border-radius: 5px;
      font-size: 14px;
      white-space: pre-line;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <h2>Pesan Baru dari {{ $nama_pengirim }}</h2>
    </div>

    <div class="content">
      <p>Hai, kamu menerima pesan baru dari <strong>{{ $nama_pengirim }}</strong>.</p>

      <div class="message-box">
        {{ $pesan }}
      </div>

      @if (!empty($fileUrl))
        <p style="margin-top: 20px;">📎 <a href="{{ route('download.file', basename($fileUrl)) }}" class="btn">Unduh Lampiran</a></p>
      @endif
      
      <p style="margin-top: 20px;">Salam hangat,<br><strong>{{ $nama_pengirim }}</strong></p>
    </div>

    <div class="footer">
      Email ini dikirim melalui <strong>SIS-APP</strong>
    </div>
  </div>
</body>
</html>