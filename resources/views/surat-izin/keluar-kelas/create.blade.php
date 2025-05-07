@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Buat Surat Izin Keluar Kelas</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
    @include('layouts.inc.alert')

    <div class="container-fluid">
        <!-- Menampilkan notifikasi di bawah header, dengan ukuran yang lebih kecil -->
        @if ($surat->isEmpty())
            <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert" style="font-size: 14px;">
                <strong>Perhatian!</strong> Belum ada surat izin keluar kelas yang dibuat hari ini.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Surat Izin Keluar Kelas
                            @if ($surat->isNotEmpty())
                                <a href="{{ route('keluar-kelas.surat', $surat->first()->id) }}" class="btn btn-dark float-right mb-3">Lihat Surat Hari Ini</a>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('keluar-kelas.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label>Tanggal Surat</label>
                                    <input type="date" name="tanggal_surat" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Kepada Yth</label>
                                    <input type="text" name="kepada_yth" class="form-control" placeholder="Masukan nama guru..." required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" required placeholder="Masukan nama anda...">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Kelas & Jurusan Siswa</label>
                                    <select name="kelas_id" class="form-control">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $kela)
                                            <option value="{{$kela->id}}">{{$kela->kelas}} - {{$kela->jurusan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Selama Jam</label>
                                    <input type="number" name="jam_ke" class="form-control" placeholder="Masukan dari jam berapa - jam berapa...">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Alasan</label>
                                    <textarea name="pesan_keluar_kelas" class="form-control" required placeholder="Masukan alasan"></textarea>
                                </div>
    
                                <div class="col-12 mt-3 text-center">
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
