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
                            <a href="{{route('PPDBonline.index')}}" class="btn btn-success float-right">Kembali</a>
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
                                    <input type="text" name="nama" placeholder="Masukan nama lengkap anda..." class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Foto Anda<span class="text-danger">*</span></label>
                                    <input type="file" name="foto_pendaftar" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukan email pribadi anda...">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>No Telepon</label>
                                    <input type="number" name="no_telp" class="form-control" placeholder="Masukan no telepon anda...">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tanggal Lahir<span class="text-danger">*</span></label>
                                    <input type="date" name="tgl_lahir" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Jenis Kelamin<span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Asal Sekolah Sebelumnya<span class="text-danger">*</span></label>
                                    <input type="text" name="asal_sekolah_sebelumnya" placeholder="Masukan nama sekolah anda sebelumnya..." class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal Mendaftar(hari ini)<span class="text-danger">*</span></label>
                                    <input type="date" name="tgl_pendaftaran" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="5"></textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection