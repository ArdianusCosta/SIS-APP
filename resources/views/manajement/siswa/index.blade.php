@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Manajemen Siswa</h1>
          <form action="#" method="GET">
              <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="search" name="cari" class="form-control" placeholder="Cari Pengguna..." aria-label="Search" value="{{ request('cari') }}">
                  <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                      </button>
                  </div>
              </div>
          </form>                           
        </div>
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
                        <h4>List Siswa
                            <a href="{{route('siswa.create')}}" class="btn btn-success float-right">Tambah Data Siswa</a>
                        </h4>
                    </div>

                    <form action="#" method="get">
                        <div class="container-fluid py-3" style="background-color: #343536">
                            <div class="row">
                                @php
                                    $dateStart = request('date_start') ?? \Carbon\Carbon::parse($firstDate)->format('Y-m-d');
                                @endphp

                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date_start" value="{{ $dateStart }}" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date_end" value="{{ request('date_end') }}" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="kelas" class="form-control" onchange="this.form.submit()">
                                        <option value="">-- Filter Kelas & Jurusan --</option>
                                        @foreach ($kelas as $kela)
                                            <option value="{{ $kela->id }}" {{ request('kelas') == $kela->id ? 'selected' : '' }}>
                                                {{ $kela->kelas }} - {{ $kela->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <select name="agama" class="form-control">
                                        <option value="">-- Agama --</option>
                                        <option value="Islam" {{request('agama') == 'Islam' ? 'selected' : ''}}>Islam</option>
                                        <option value="Kristen" {{request('agama') == 'Kristen' ? 'selected' : ''}}>Kristen</option>
                                        <option value="Katolik" {{request('agama') == 'Katolik' ? 'selected' : ''}}>Katolik</option>
                                        <option value="Hindu" {{request('agama') == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                                        <option value="Buddha" {{request('agama') == 'Buddha' ? 'selected' : ''}}>Buddha</option>
                                        <option value="Konghucu" {{request('agama') == 'Konghucu' ? 'selected' : ''}}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <button type="submit" class="btn btn-warning btn-block">Filter</button>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <a href="{{route('siswa.import')}}" class="btn btn-warning btn-block">EXPORT</a>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModalCenter">IMPORT</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Import Data Siswa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                        <form action="{{route('siswa.import')}}" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                        @csrf
                                                        <input type="file" name="file" required>
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Selesai</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            </div>
                                        </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Siswa</th>
                                    <th class="text-center">Kelas & Jurusan Siswa</th>
                                    <th class="text-center">Wali Kelas Siswa</th>
                                    <th class="text-center">Tempat, Tanggal Lahir Siswa</th>
                                    <th class="text-center">Jenis Kelamin Siswa</th>
                                    <th class="text-center">Nomor Induk Siswa (NIS)</th>
                                    <th class="text-center">Agama Siswa</th>
                                    <th class="text-center">Jumlah Saudara Siswa</th>
                                    <th class="text-center">Email Siswa</th>
                                    <th class="text-center">Nomor Telepon Siswa</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                    <tr>
                                        <td class="text-center">{{$siswas->firstItem() + $loop->index}}</td>
                                        <td class="text-center">{{$siswa->nama}}</td>
                                        <td class="text-center">{{$siswa->kelas->kelas}} - {{($siswa->kelas->jurusan)}}</td>
                                        <td class="text-center">{{$siswa->waliKelas->nama}}</td>
                                        <td class="text-center">{{$siswa->tempat_lahir}}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y')}}</td>
                                        <td class="text-center">{{$siswa->jenis_kelamin}}</td>
                                        <td class="text-center">{{$siswa->nis}}</td>
                                        <td class="text-center">{{$siswa->agama}}</td>
                                        <td class="text-center">{{$siswa->jumlah_saudara}} Orang</td>
                                        <td class="text-center">{{$siswa->email}}</td>
                                        <td class="text-center">{{$siswa->no_telepon}}</td>
                                        <td class="clas-center">{{$siswa->alamat}}</td>
                                        <td class="text-center">
                                            <div class="d-grid gap-2">
                                                <a href="{{route('siswa.edit', $siswa->id)}}" class="btn btn-warning mr-2 mb-2">Edit</a>
                                                <form action="{{route('siswa.destroy', $siswa->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Hapus" class="btn btn-danger mr-2 mb-2">
                                                </form>
                                            </div>
                                        </td>
                                    </tr>   
                                @endforeach
                            </tbody>
                        </table>

                        <div class="col-12">
                            <div class="pagination-wrapper mt-3">
                                {{$siswas->links()}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection