@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Manajement Siswa</h1>
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
                    <div class="card-body">
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
    </div>
   
@endsection