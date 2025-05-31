@extends('layouts.main')

@php
    $title = 'PPDB-Online'
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>PPDB-Online</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar PPDB-Online
                        <a href="{{ route('PPDBonline.index') }}" class="btn btn-success float-right">Kembali</a>
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{route('PPDBonline.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap Anda..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Foto Anda<span class="text-danger">*</span></label>
                                <input type="file" name="foto_pendaftar" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NISN<span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN Anda..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIK<span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK Anda..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif Anda...">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>No Telepon</label>
                                <input type="text" name="no_telp" class="form-control" placeholder="Contoh: 081234567890">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tempat Lahir<span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir Anda..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir<span class="text-danger">*</span></label>
                                <input type="date" name="tgl_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin<span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Asal Sekolah Sebelumnya<span class="text-danger">*</span></label>
                                <input type="text" name="asal_sekolah_sebelumnya" class="form-control" placeholder="Masukkan nama sekolah asal Anda..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nama Ayah<span class="text-danger">*</span></label>
                                <input type="text" name="nama_ayah" class="form-control" placeholder="Masukkan nama ayah Anda..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nama Ibu<span class="text-danger">*</span></label>
                                <input type="text" name="nama_ibu" class="form-control" placeholder="Masukkan nama ibu Anda..." required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Tanggal Mendaftar<span class="text-danger">*</span></label>
                                <input type="date" name="tgl_pendaftaran" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan alamat lengkap Anda..."></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
