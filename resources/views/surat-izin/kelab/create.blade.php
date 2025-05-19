@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Buat Surat Izin Ke Lab</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
    @include('layouts.inc.alert')

    <div class="container-fluid">
        @if ($keLab->isEmpty())
            <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert" style="font-size: 14px;">
                <strong>Perhatian!</strong> Belum ada surat izin Ke Lab yang dibuat hari ini.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Surat Izin Ke Lab
                            @if ($keLab->isNotEmpty())
                                <a href="{{route('surat-kelab', $keLab->first()->id)}}" class="btn btn-dark float-right mb-3">Lihat Surat Hari Ini</a>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('kelab-store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label>Nama Penanggung Jawab<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_penanggung_jawab" class="form-control" placeholder="Masukan nama penaggung jawab..." required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Tanggal Mulai Izin<span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_izin" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Tanggal Selesai Izin<span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_selesai" class="form-control" 
                                           value="{{ \Carbon\Carbon::parse($tanggal_selesai ?? $tanggal_izin ?? now())->addDay()->format('Y-m-d') }}" 
                                           min="{{ \Carbon\Carbon::parse($tanggal_izin ?? now())->format('Y-m-d') }}" 
                                           required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Kepada Yth<span class="text-danger">*</span></label>
                                    <input type="text" name="kepada_yth" class="form-control" placeholder="Masukan nama guru K3..." required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Nama<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama" required placeholder="Masukan nama anda...">
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
                                    <label>Dari Jam<span class="text-danger">*</span></label>
                                    <input type="time" name="jam_ke" id="jam_ke" class="form-control" 
                                           value="{{ old('jam_ke', $jam_ke ?? now()->format('H:i')) }}" 
                                           required placeholder="Masukkan dari jam berapa">
                                </div>
                                <div class="col-6 mb-3">
                                    <label>Sampai Jam<span class="text-danger">*</span></label>
                                    <input type="time" name="sampai_jam" id="sampai_jam" class="form-control" 
                                           value="{{ old('sampai_jam', \Carbon\Carbon::parse($jam_ke ?? now())->addHour()->format('H:i')) }}" 
                                           min="{{ \Carbon\Carbon::parse($jam_ke ?? now())->format('H:i') }}" 
                                           required placeholder="Masukkan sampai jam berapa">
                                </div>
                                
                                <script>
                                    const jamKe = document.getElementById('jam_ke');
                                    const sampaiJam = document.getElementById('sampai_jam');
                                
                                    jamKe.addEventListener('change', function () {
                                        const jamKeTime = this.value;
                                        if (jamKeTime) {
                                            // Set min untuk sampai_jam
                                            sampaiJam.min = jamKeTime;
                                            // Set default sampai_jam ke jam_ke + 1 jam
                                            const date = new Date(`1970-01-01T${jamKeTime}:00`);
                                            date.setHours(date.getHours() + 1);
                                            sampaiJam.value = date.toTimeString().slice(0, 5); // Format HH:mm
                                        }
                                    });
                                
                                    sampaiJam.addEventListener('change', function () {
                                        const jamKeTime = jamKe.value;
                                        const sampaiJamTime = this.value;
                                        if (jamKeTime && sampaiJamTime && sampaiJamTime <= jamKeTime) {
                                            // Reset ke jam_ke + 1 jam jika mundur
                                            const date = new Date(`1970-01-01T${jamKeTime}:00`);
                                            date.setHours(date.getHours() + 1);
                                            this.value = date.toTimeString().slice(0, 5);
                                            alert('Waktu selesai harus lebih besar dari waktu mulai!');
                                        }
                                    });
                                </script>
                                <div class="col-12 mb-3">
                                    <label>Alasan<span class="text-danger">*</span></label>
                                    <textarea name="pesan_keluar_kelas" class="form-control" rows="5" required placeholder="Masukan alasan"></textarea>
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
