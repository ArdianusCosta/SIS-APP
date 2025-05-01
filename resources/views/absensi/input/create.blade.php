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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Masukan Data</h4>
                    </div>
                    <div class="card-body">
                       <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" required placeholder="Masukan nama...">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>Kelas</label>
                                    <select name="kelas" class="form-control">
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="">X</option>
                                        <option value="">XI</option>
                                        <option value="">XII</option>
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
                                    <label>Status Kehadiran</label>
                                        <select name="" class="form-control">
                                            <option value="">-- Pilih Status Kehadiran --</option>
                                            <option value="">Hadir</option>
                                            <option value="">Sakit</option>
                                            <option value="">Izin</option>
                                            <option value="">Alpha</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <textarea name="" class="form-control"></textarea>
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