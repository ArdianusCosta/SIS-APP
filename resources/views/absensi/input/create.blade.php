@extends('layouts.main')

@php
    $title = 'Absensi-Input'
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Absensi-Input</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
@include('layouts.inc.alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Masukan Data</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{route('absensi-input.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>Nama Siswa<span class="text-danger">*</span></label>
                                    <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required placeholder="Ketik nama siswa...">
                                    <input type="hidden" name="siswa_id" id="siswa_id">
                                    <div id="list_siswa" class="list-group position-absolute w-100" style="z-index: 1000;"></div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const input = document.getElementById('nama_siswa');
                                            const list = document.getElementById('list_siswa');
                                            const hidden = document.getElementById('siswa_id');
                                        
                                            input.addEventListener('input', async () => {
                                                const q = input.value.trim();
                                                if (q.length < 2) return list.innerHTML = '';
                                        
                                                const res = await fetch(`/absensi/input/cari?query=${q}`);
                                                const siswa = await res.json();
                                        
                                                list.innerHTML = siswa.map(s => 
                                                    `<div class="list-group-item list-group-item-action" data-id="${s.id}" data-nama="${s.nama}">${s.nama}</div>`
                                                ).join('');
                                            });
                                        
                                            list.addEventListener('click', e => {
                                                if (e.target.dataset.id) {
                                                    input.value = e.target.dataset.nama;
                                                    hidden.value = e.target.dataset.id;
                                                    list.innerHTML = '';
                                                }
                                            });
                                        });
                                    </script>                                                                             
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>Kelas & Jurusan<span class="text-danger">*</span></label>
                                    <select name="kelas_id" class="form-control" required>
                                        <option value="">-- Pilih Kelas & Jurusan --</option>
                                        @foreach ($kelas as $kela)
                                            <option value="{{$kela->id}}">{{$kela->kelas}} & {{$kela->jurusan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>Jam Sekarang (Otomatis)</label>
                                    <input type="text" id="jam_digital_display" class="form-control" readonly>
                                    <input type="hidden" name="tanggal_waktu" id="jam_digital_value">
                                </div>                                
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const display = document.getElementById('jam_digital_display');
                                        const hiddenInput = document.getElementById('jam_digital_value');
                                
                                        function updateJam() {
                                            const now = new Date();
                                            const pad = (n) => n.toString().padStart(2, '0');
                                
                                            const tampil = `${pad(now.getDate())}-${pad(now.getMonth() + 1)}-${now.getFullYear()} ${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
                                            display.value = tampil;
                                
                                            const kirim = `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())}T${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
                                            hiddenInput.value = kirim;
                                        }
                                
                                        setInterval(updateJam, 1000);
                                        updateJam();
                                    });
                                </script>                                
                                
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>Status Kehadiran<span class="text-danger">*</span></label>
                                        <select name="status_kehadiran" class="form-control" required>
                                            <option value="">-- Pilih Status Kehadiran --</option>
                                            <option value="Hadir">Hadir</option>
                                            <option value="Sakit">Sakit</option>
                                            <option value="Izin">Izin</option>
                                            <option value="Alpha">Alpha</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                                </div>
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