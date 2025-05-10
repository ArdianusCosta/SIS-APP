@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Manajement Siswa
          </h1>                           
        </div>
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
                        <h4>Tambah Data Siswa
                            <a href="{{route('siswa.index')}}" class="btn btn-success float-right">Kembali</a>
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
                        <form action="{{route('siswa.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label>Nama Siswa<span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" required placeholder="Masukan nama siswa...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Kelas & Jurusan Siswa<span class="text-danger">*</span></label>
                                    <select name="kelas_id" required class="form-control">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $kela)
                                            <option value="{{$kela->id}}">{{$kela->kelas}} - {{$kela->jurusan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Wali Kelas Siswa</label>
                                    <select name="wali_kelas_id" class="form-control">
                                        <option value="">-- Pilih Wali Kelas --</option>
                                        @foreach ($gurus as $guru)
                                            <option value="{{$guru->id}}">{{$guru->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Tempat Lahir Siswa</label>
                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukan tempat lahir siswa...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Tanggal Lahir Siswa<span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label>Jenis Kelamin Siswa<span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" required class="form-control">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Nomor Induk Siswa (NIS)<span class="text-danger">*</span></label>
                                    <input type="number" name="nis" class="form-control" required placeholder="Ketikan nis...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Agama Siswa<span class="text-danger">*</span></label>
                                    <select name="agama" class="form-control" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen </option>
                                        <option value="Katolik">Katolik </option>
                                        <option value="Hindu">Hindu </option>
                                        <option value="Buddha">Buddha </option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Jumlah Saudara Siswa</label>
                                    <input type="number" class="form-control" name="jumlah_saudara" placeholder="Ketikan jumlah saudara...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Email Siswa</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukan email...">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Nomor Telepon Siswa</label>
                                    <input type="number" name="no_telepon" class="form-control" placeholder="Ketikan nomor telepon...">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Alamat<span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control" rows="5" required placeholder="Masukan alamat..."></textarea>
                                </div>

                                <div class="col-12 mb-3 text-center">
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