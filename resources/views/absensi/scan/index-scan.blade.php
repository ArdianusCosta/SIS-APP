@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 80vh;">
        <h3 class="mb-4 text-center">Scan QR Code</h3>

        <div id="reader" style="width:450px;"></div>

        <form id="absensi-form" action="{{ route('indexScan-submit') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="nis" id="nis">
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/html5-qrcode/html5-qrcode.min.js')}}" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('nis').value = decodedText;
            document.getElementById('absensi-form').submit();
        }

        const html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: 250 },
            onScanSuccess
        );
    </script>
@endsection
