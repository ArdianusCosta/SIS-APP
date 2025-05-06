@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 80vh;">
        <h3 class="mb-4 text-center">Generate QR Code untuk Absensi</h3>

        {{-- Form Generate QR --}}
        <form action="{{ route('generate-qr.code') }}" method="POST" class="mb-5" style="width: 100%; max-width: 500px;">
            @csrf
            <div class="form-group">
                <label for="link">Masukkan Link Absensi:</label>
                <input type="url" name="link" id="link" class="form-control" placeholder="https://..." required>
            </div>
            <button type="submit" class="btn btn-primary mt-3 w-100">Generate QR Code</button>
        </form>

        <form id="absensi-form" action="{{ route('generate-qr.code') }}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="nis" id="nis">
        </form>
        @if(isset($qr))
    <div class="text-center mt-4">
        <h5>QR Code:</h5>
        <div>{!! $qr !!}</div>

        @if(isset($foto))
            <div class="mt-4">
                <h5>Foto Siswa:</h5>
                <img src="{{ asset('storage/foto-siswa/' . $foto) }}" alt="Foto Siswa" style="max-width: 200px; border-radius: 8px;">
            </div>
        @endif
    </div>
@endif

    </div>
@endsection
