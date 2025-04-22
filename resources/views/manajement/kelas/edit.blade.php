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
                        <h4>Edit Data Kelas
                            <a href="{{route('kelas.index')}}" class="btn btn-success float-right">Kembali</a>
                        </h4>
                    </div>
                    <form action="{{route('kelas.update',$kelas->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label>Kelas</label>
                                <select name="kelas" class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X" {{$kelas->kelas == 'X' ? 'selected' : ''}}>Kelas X</option>
                                    <option value="XI" {{$kelas->kelas == 'XI' ? 'selected' : ''}}>Kelas XI</option>
                                    <option value="XII" {{$kelas->kelas == 'XII' ? 'selected' : ''}}>Kelas XII</option>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label>Jurusan</label>
                                <select name="jurusan" class="form-control">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="RPL" {{$kelas->jurusan == 'RPL' ? 'selected' : ''}}>Rekayasa Perangkat Lunak (RPL)</option>
                                    <option value="DKV" {{$kelas->jurusan == 'DKV' ? 'selected' : ''}}>Desain Komunikasi Visual (DKV)</option>
                                    <option value="KULINER" {{$kelas->jurusan == 'KULINER' ? 'selected' : ''}}>Kuliner</option>
                                    <option value="TP" {{$kelas->jurusan == 'TP' ? 'selected' : ''}}>Teknik Pengelasan (TP)</option>
                                    <option value="TKP" {{$kelas->jurusan == 'TKP' ? 'selected' : ''}}>Teknik Konstruksi dan Perumahan (TKP)</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label>Wali Kelas</label>
                                <select name="wali_kelas_id" class="form-control">
                                    <option value="">-- Pilih Wali Kelas --</option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}" {{ $kelas->wali_kelas_id == $guru->id ? 'selected' : '' }}>
                                            {{ $guru->nama }}
                                        </option>
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