@extends('layouts.main')

@php
    $title = 'Buat Guru'
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Manajement Guru</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Guru
                            <a href="{{route('guru.index')}}" class="btn btn-success float-right">Kembali</a>
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
                        <form action="{{route('guru.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" required placeholder="Masukan nama...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                        <option value="Magang">Magang</option>
                                        <option value="Cuti">Cuti</option>
                                        <option value="Pensiun">Pensiun</option>
                                        <option value="Keluar">Keluar</option>
                                        <option value="Dikeluarkan">Dikeluarkan</option>
                                    </select>
                                </div>                                
                                <div class="col-6 mb-3">
                                    <label>Jabatan</label>
                                    <select name="jabatan" class="form-control" required>
                                        <option value="">-- Pilih jabatan --</option>
                                        <option value="Guru">Guru</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Kepala Sekolah">Kepala Sekolah</option>
                                        <option value="Yayasan">Yayasan</option>
                                        <option value="Ketua Yayasan">Ketua Yayasan</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Nomor Induk Karyawan</label>
                                    <input type="number" name="nik" class="form-control" placeholder="Masukan nomor induk karyawan">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Pendidikan</label>
                                    <input type="text" name="pendidikan" class="form-control" required placeholder="Masukan pendidikan...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Mata Pelajaran yang diampuh</label>
                                    <input type="text" name="mata_pelajaran" class="form-control" placeholder="Masukan mata pelajaran...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih jenis kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Agama</label>
                                    <select name="agama" class="form-control" required>
                                        <option value="">-- Pilih agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required placeholder="Masukan tempat lahir">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Nomor Telepon Guru</label>
                                    <input type="number" name="no_telepon" class="form-control" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Foto</label>
                                    <input type="file" name="img" class="form-control">
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="5"></textarea>
                                    </div>
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