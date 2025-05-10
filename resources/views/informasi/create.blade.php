@extends('layouts.main')

@section('content')
<div class="card-body">
    <h5 class="mb-2">Buat Informasi & Penggumuman
        <a href="{{route('informasi.index')}}" class="btn btn-success float-right">Kembali</a>
    </h5>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('informasi.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-3">
                            <label>Judul<span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control" required placeholder="Masukan judul...">
                        </div>
                        <div class="col-12 mb-3">
                            <label>Kategori<span class="text-danger">*</span></label>
                            <select name="kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Pengumuman">Kategori Pengumuman</option>
                                <option value="Jadwal Acara">Kategori Jadwal Acara</option>
                                <option value="Kegiatan Akademik">Kategori Kegiatan Akademik</option>
                                <option value="Ekstrakurikuler">Kategori Ekstrakurikuler</option>
                                <option value="Organisasi Sekolah">Kategori Organisasi Sekolah</option>
                                <option value="Pelayanan">Kategori Pelayanan</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Isi Informasi/Berita<span class="text-danger">*</span></label>
                            <textarea name="isi" class="form-control" rows="5" required placeholder="Masukan isi informasi/berita..."></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Tanggal Pembuatan Informasi/Berita<span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label>Lampiran untuk Informasi/Berita</label>
                            <input type="file" name="lampiran" class="form-control">
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary">Post Informasi/Berita</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection