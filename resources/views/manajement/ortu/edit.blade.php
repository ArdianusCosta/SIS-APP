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
                        <h4>Edit Data Orang Tua</h4>
                        <a href="{{route('ortu.index')}}" class="btn btn-success float-right">Kembali</a>
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
                        <form action="{{route('ortu.update', $orang_tua->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label>Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-control" required placeholder="Masukan nama ayah..." value="{{$orang_tua->nama_ayah}}">

                                    <label>Tempat Lahir Ayah</label>
                                    <input type="text" name="tempat_lahir_ayah" class="form-control" placeholder="Masukan tempat lahir ayah..." value="{{$orang_tua->tempat_lahir_ayah}}">

                              
                                    <label>Tanggal Lahir Ayah</label>
                                    <input type="date" name="tanggal_lahir_ayah" class="form-control" required value="{{$orang_tua->tanggal_lahir_ayah}}">

                                        <label>Agama</label>
                                        <select name="agama_ayah" class="form-control" required>
                                            <option value="">-- Pilih agama --</option>
                                            <option value="Islam" {{$orang_tua->agama_ayah == 'Islam' ? 'selected' : ''}}>Islam</option>
                                            <option value="Kristen" {{$orang_tua->agama_ayah == 'Kristen' ? 'selected' : ''}}>Kristen</option>
                                            <option value="Katolik" {{$orang_tua->agama_ayah == 'Katolik' ? 'selected' : ''}}>Katolik</option>
                                            <option value="Hindu" {{$orang_tua->agama_ayah == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                                            <option value="Buddha" {{$orang_tua->agama_ayah == 'Buddha' ? 'selected' : ''}}>Buddha</option>
                                            <option value="Konghucu" {{$orang_tua->agama_ayah == 'Konghucu' ? 'selected' : ''}}>Konghucu</option>
                                        </select>
                             
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin_ayah" class="form-control" required>
                                        <option value="">-- Pilih jenis kelamin --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin_ayah', $orang_tua->jenis_kelamin_ayah ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    </select>
                               
                                    <label>Pendidikan Terakhir Ayah</label>
                                    <select name="pendidikan_terakhir_ayah" required class="form-control">
                                        @foreach(['SD','SMP','SMA','SMK','D1','D2','D3','D4','S1','S2','S3'] as $edu)
                                            <option value="{{ $edu }}" {{ old('pendidikan_terakhir_ayah', $orang_tua->pendidikan_terakhir_ayah ?? '') == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                                        @endforeach
                                    </select>
                           
                                    <label>Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah" class="form-control" required placeholder="Masukan pekerjaan ayah..." value="{{$orang_tua->pekerjaan_ayah}}">
                               
                                    <label>Nomor Telepon Ayah</label>
                                    <input type="number" name="nomor_telepon_ayah" class="form-control" placeholder="Masukan nomor telepon ayah..." value="{{$orang_tua->nomor_telepon_ayah}}">

                                    <label>Alamat Email Ayah</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukan alamat email ayah..." value="{{$orang_tua->email}}">
                               
                                    <label>Alamat</label>
                                    <textarea name="alamat_ayah" class="form-control" rows="5" required placeholder="Masukan alamat...">{{$orang_tua->alamat_ayah}}</textarea>
                                </div>

                                <div class="col-6 mb-3">
                                    <label>Nama Ibu</label>
                                    <input type="text" name="nama_ibu" class="form-control" required placeholder="Masukan nama ibu..." value="{{$orang_tua->nama_ibu}}">
                                    
                                    <label>Tempat Lahir Ibu</label>
                                    <input type="text" name="tempat_lahir_ibu" class="form-control" placeholder="Masukan tempat lahir ibu..." value="{{$orang_tua->tempat_lahir_ibu}}">

                                    <label>Tanggal Lahir Ibu</label>
                                    <input type="date" name="tanggal_lahir_ibu" class="form-control" required value="{{$orang_tua->tanggal_lahir_ibu}}">

                                        <label>Agama</label>
                                        <select name="agama_ibu" class="form-control" required>
                                            <option value="">-- Pilih agama --</option>
                                            <option value="Islam" {{$orang_tua->agama_ibu == 'Islam' ? 'selected' : ''}}>Islam</option>
                                            <option value="Kristen" {{$orang_tua->agama_ibu == 'Kristen' ? 'selected' : ''}}>Kristen</option>
                                            <option value="Katolik" {{$orang_tua->agama_ibu == 'Katolik' ? 'selected' : ''}}>Katolik</option>
                                            <option value="Hindu" {{$orang_tua->agama_ibu == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                                            <option value="Buddha" {{$orang_tua->agama_ibu == 'Buddha' ? 'selected' : ''}}>Buddha</option>
                                            <option value="Konghucu" {{$orang_tua->agama_ibu == 'Konghucu' ? 'selected' : ''}}>Konghucu</option>
                                        </select>

                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin_ibu" class="form-control" required>
                                        <option value="">-- Pilih jenis kelamin --</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin_ibu', $orang_tua->jenis_kelamin_ibu ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>

                                    <label>Pendidikan Terakhir Ibu</label>
                                    <select name="pendidikan_terakhir_ibu" required class="form-control">
                                        @foreach(['SD','SMP','SMA','SMK','D1','D2','D3','D4','S1','S2','S3'] as $edu)
                                            <option value="{{ $edu }}" {{ old('pendidikan_terakhir_ibu', $orang_tua->pendidikan_terakhir_ibu ?? '') == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                                        @endforeach
                                    </select>

                                    <label>Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu" class="form-control" required placeholder="Masukan pekerjaan ibu..." value="{{$orang_tua->pekerjaan_ibu}}">

                                    <label>Nomor Telepon Ibu</label>
                                    <input type="number" name="nomor_telepon_ibu" class="form-control" placeholder="Masukan nomor telepon ibu..." value="{{$orang_tua->nomor_telepon_ibu}}">

                                    <label>Alamat Email Ibu</label>
                                    <input type="email" name="email1" class="form-control" placeholder="Masukan alamat email ibu..." value="{{$orang_tua->email1}}">

                                    <label>Alamat</label>
                                    <textarea name="alamat_ibu" class="form-control" rows="5" required placeholder="Masukan alamat...">{{$orang_tua->alamat_ibu}}</textarea>
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