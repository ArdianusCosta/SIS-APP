@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Manajement Kelas
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
                        <h4>Tambah Data Kelas
                            <a href="{{route('kelas.index')}}" class="btn btn-success float-right">Kembali</a>
                        </h4>
                    </div>
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{route('kelas.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label>Kelas<span class="text-danger">*</span></label>
                                <select name="kelas" required class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X">Kelas X</option>
                                    <option value="XI">Kelas XI</option>
                                    <option value="XII">Kelas XII</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label>Jurusan<span class="text-danger">*</span></label>
                                <select name="jurusan" required class="form-control">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="RPL">Rekayasa Perangkat Lunak (RPL)</option>
                                    <option value="DKV">Desain Komunikasi Visual (DKV)</option>
                                    <option value="KULINER">Kuliner</option>
                                    <option value="TP">Teknik Pengelasan (TP)</option>
                                    <option value="TKP">Teknik Konstruksi dan Perumahan (TKP)</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Wali Kelas<span class="text-danger">*</span></label>
                                <select name="wali_kelas_id" required class="form-control">
                                    <option value="">-- Pilih Wali Kelas --</option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{$guru->id}}">{{$guru->nama}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection