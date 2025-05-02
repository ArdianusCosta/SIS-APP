@extends('layouts.main')

@section('content')
<div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 80vh;">
    <h3 class="mb-4 text-center">Absensi Scan QR Code</h3>

    <div id="reader" style="width:450px;"></div>

    <form id="absensi-form" action="{{ route('indexScan-submit') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="nis" id="nis">
    </form>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js" type="text/javascript"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const html5QrCode = new Html5Qrcode("reader");

        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('nis').value = decodedText;
            document.getElementById('absensi-form').submit();
        }

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                console.log("Available cameras:", devices);
                const cameraId = devices[0].id; // Gunakan kamera pertama (bisa diubah ke devices[1] untuk kamera belakang di HP)
                html5QrCode.start(
                    cameraId,
                    { fps: 10, qrbox: 250 },
                    onScanSuccess
                );
            } else {
                alert("Tidak ada kamera ditemukan.");
            }
        }).catch(err => {
            console.error("Gagal akses kamera:", err);
            alert("Gagal mengakses kamera: " + err);
        });
    });
</script>
@endpush

