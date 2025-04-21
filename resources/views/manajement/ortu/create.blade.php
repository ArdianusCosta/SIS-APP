@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Manajement Orang Tua
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
                        <h4>Tambah Data Orang Tua</h4>
                        <a href="{{route('ortu.index')}}" class="btn btn-success float-right">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('ortu.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label>Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-control" required placeholder="Masukan nama ayah">

                                    <label>Tempat Lahir Ayah</label>
                                    <input type="text" name="tempat_lahir_ayah" class="form-control" placeholder="Masukan tempat lahir ayah...">

                              
                                    <label>Tanggal Lahir Ayah</label>
                                    <input type="date" name="tanggal_lahir_ayah" class="form-control" required>

                                        <label>Agama</label>
                                        <select name="agama_ayah" class="form-control" required>
                                            <option value="">-- Pilih agama --</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                             
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin_ayah" class="form-control" required>
                                        <option value="">-- Pilih jenis kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                    </select>
                               
                                    <label>Pendidikan Terakhir Ayah</label>
                                    <select name="pendidikan_terakhir_ayah" required class="form-control">
                                        <option value="">-- Pilih pendidikan terakhir --</option>
                                        <option value="SD">SD (Sekolah Dasar)</option>
                                        <option value="SMP">SMP (Sekolah Menengah Pertama)</option>
                                        <option value="SMA">SMA (Sekolah Menengah Akhir)</option>   
                                        <option value="SMK">SMK (Sekolah Menengah Kejuruan)</option>
                                        <option value="D1">D1 (Diploma 1)</option>
                                        <option value="D2">D2 (Diploma 2)</option>
                                        <option value="D3">D3 (Diploma 3)</option>
                                        <option value="D4">D4 (Diploma 4)</option>
                                        <option value="S1">S1 (Sarjana)</option>
                                        <option value="S2">S2 (Magister)</option>
                                        <option value="S3">S3 (Doktor)</option>
                                    </select>
                           
                                    <label>Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah" class="form-control" required placeholder="Masukan pekerjaan ayah...">
                               
                                    <label>Nomor Telepon Ayah</label>
                                    <input type="number" name="nomor_telepon_ayah" class="form-control" placeholder="Masukan nomor telepon ayah...">

                                    <label>Alamat Email Ayah</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukan alamat email ayah...">
                               
                                    <label>Alamat</label>
                                    <textarea name="alamat_ayah" class="form-control" rows="5" required placeholder="Masukan alamat..."></textarea>
                                </div>

                                <div class="col-6 mb-3">
                                    <label>Nama Ibu</label>
                                    <input type="text" name="nama_ibu" class="form-control" required placeholder="Masukan nama ibu">
                                    
                                    <label>Tempat Lahir Ibu</label>
                                    <input type="text" name="tempat_lahir_ibu" class="form-control" placeholder="Masukan tempat lahir ibu...">

                                    <label>Tanggal Lahir Ibu</label>
                                    <input type="date" name="tanggal_lahir_ibu" class="form-control" required>

                                        <label>Agama</label>
                                        <select name="agama_ibu" class="form-control" required>
                                            <option value="">-- Pilih agama --</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>

                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin_ibu" class="form-control" required>
                                        <option value="">-- Pilih jenis kelamin --</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>

                                    <label>Pendidikan Terakhir Ibu</label>
                                    <select name="pendidikan_terakhir_ibu" required class="form-control">
                                        <option value="">-- Pilih pendidikan terakhir --</option>
                                        <option value="SD">SD (Sekolah Dasar)</option>
                                        <option value="SMP">SMP (Sekolah Menengah Pertama)</option>
                                        <option value="SMA">SMA (Sekolah Menengah Akhir)</option>   
                                        <option value="SMK">SMK (Sekolah Menengah Kejuruan)</option>
                                        <option value="D1">D1 (Diploma 1)</option>
                                        <option value="D2">D2 (Diploma 2)</option>
                                        <option value="D3">D3 (Diploma 3)</option>
                                        <option value="D4">D4 (Diploma 4)</option>
                                        <option value="S1">S1 (Sarjana)</option>
                                        <option value="S2">S2 (Magister)</option>
                                        <option value="S3">S3 (Doktor)</option>
                                    </select>

                                    <label>Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu" class="form-control" required placeholder="Masukan pekerjaan ibu...">

                                    <label>Nomor Telepon Ibu</label>
                                    <input type="number" name="nomor_telepon_ibu" class="form-control" placeholder="Masukan nomor telepon ibu...">

                                    <label>Alamat Email Ibu</label>
                                    <input type="email" name="email1" class="form-control" placeholder="Masukan alamat email ibu...">

                                    <label>Alamat</label>
                                    <textarea name="alamat_ibu" class="form-control" rows="5" required placeholder="Masukan alamat..."></textarea>
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