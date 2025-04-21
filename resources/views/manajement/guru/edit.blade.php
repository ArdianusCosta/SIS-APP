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
                        <h4>Edit Guru
                            <a href="{{route('guru.index')}}" class="btn btn-success float-right">Kembali</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('guru.update', $guru->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{$guru->nama}}" required placeholder="Masukan nama...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Aktif" {{$guru->status == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                        <option value="Tidak Aktif" {{$guru->status == 'Tidak Aktif' ? 'selected' : ''}}>Tidak Aktif</option>
                                        <option value="Magang" {{$guru->status == 'Magang' ? 'selected' : ''}}>Magang</option>
                                        <option value="Cuti" {{$guru->status == 'Cuti' ? 'selected' : ''}}>Cuti</option>
                                        <option value="Pensiun" {{$guru->status == 'Pensiun' ? 'selected' : ''}}>Pensiun</option>
                                        <option value="Keluar" {{$guru->status == 'Keluar' ? 'selected' : ''}}>Keluar</option>
                                        <option value="Dikeluarkan" {{$guru->status == 'Dikeluarkan' ? 'selected' : ''}}>Dikeluarkan</option>
                                    </select>
                                </div>                                
                                <div class="col-6 mb-3">
                                    <label>Jabatan</label>
                                    <select name="jabatan" class="form-control" required>
                                        <option value="">-- Pilih jabatan --</option>
                                        <option value="Guru" {{$guru->jabatan == 'Guru' ? 'selected' : ''}}>Guru</option>
                                        <option value="Staff" {{$guru->jabatan == 'Staff' ? 'selected' : ''}}>Staff</option>
                                        <option value="Kepala Sekolah" {{$guru->jabatan == 'Kepala Sekolah' ? 'selected' : ''}}>Kepala Sekolah</option>
                                        <option value="Yayasan" {{$guru->jabatan == 'Yayasan' ? 'selected' : ''}}>Yayasan</option>
                                        <option value="Ketua Yayasan" {{$guru->jabatan == 'Ketua Yayasan' ? 'selected' : ''}}>Ketua Yayasan</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Nomor Induk Karyawan</label>
                                    <input type="number" name="nik" class="form-control" value="{{$guru->nik}}" placeholder="Masukan nomor induk karyawan">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Pendidikan</label>
                                    <input type="text" name="pendidikan" class="form-control" value="{{$guru->pendidikan}}" required placeholder="Masukan pendidikan...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Mata Pelajaran yang diampuh</label>
                                    <input type="text" name="mata_pelajaran" class="form-control" value="{{$guru->mata_pelajaran}}" placeholder="Masukan mata pelajaran...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih jenis kelamin --</option>
                                        <option value="Laki-laki" {{$guru->jenis_kelamin == 'Laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                                        <option value="Perempuan" {{$guru->jenis_kelamin == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Agama</label>
                                    <select name="agama" class="form-control" required>
                                        <option value="">-- Pilih agama --</option>
                                        <option value="Islam" {{$guru->agama == 'Islam' ? 'selected' : ''}}>Islam</option>
                                        <option value="Kristen" {{$guru->agama == 'Kristen' ? 'selected' : ''}}>Kristen</option>
                                        <option value="Katolik" {{$guru->agama == 'Katolik' ? 'selected' : ''}}>Katolik</option>
                                        <option value="Hindu" {{$guru->agama == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                                        <option value="Buddha" {{$guru->agama == 'Buddha' ? 'selected' : ''}}>Buddha</option>
                                        <option value="Konghucu" {{$guru->agama == 'Konghucu' ? 'selected' : ''}}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" value="{{$guru->tempat_lahir}}" required placeholder="Masukan tempat lahir">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" value="{{$guru->tanggal_lahir}}" required>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="5">{{$guru->alamat}}</textarea>
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