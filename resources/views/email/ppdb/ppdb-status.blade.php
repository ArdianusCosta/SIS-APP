<!DOCTYPE html>
<html>
<head>
    <title>Status Pendaftaran</title>
</head>
<body>
    <h2>Halo {{ $registrasi->nama }},</h2>

    @if ($registrasi->status === 'Disetujui')
        <p>Selamat! Anda <strong>DITERIMA</strong> di sekolah kami.</p>
    @elseif ($registrasi->status === 'Ditolak')
        <p>Mohon maaf, pendaftaran Anda <strong>DITOLAK</strong>.</p>
    @endif

    <p>Terima kasih telah mendaftar.</p>
</body>
</html>
