@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Manajement Orang Tua</h1>
          <form action="{{route('ortu.index')}}" method="GET">
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
    <div class="continer-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Orang Tua
                            <a href="{{route('ortu.create')}}" class="btn btn-success float-right">Tambah Data Orang Tua</a>
                        </h4>
                    </div>

                    <form action="#" method="get">
                        <div class="container-fluid p-3" style="background-color: #343536">
                            <div class="row">
                                @php
                                    $dateStart = request('date_start') ?? \Carbon\Carbon::parse($firstDate)->format('Y-m-d');
                                @endphp

                                <div class="col-md-3 mb-2">
                                    <input type="date" name="date_start" value="{{ $dateStart }}" class="form-control">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <input type="date" name="date_end" value="{{ request('date_end') }}" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="submit" class="btn btn-warning btn-block">Filter</button>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <a href="{{route('ortu.export')}}" class="btn btn-warning btn-block">EXPORT</a>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModalCenter">IMPORT</a>
                                     <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Import Data Orang Tua</h5>
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

                    {{-- <div class="card-body"> --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Ayah</th>
                                        <th class="text-center">Tempat, Tanggal Lahir Ayah</th>
                                        <th class="text-center">Agama Ayah</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Pendidikan Terakhir Ayah</th>
                                        <th class="text-center">Pekerjaan Ayah</th>
                                        <th class="text-center">Nomor Telepon Ayah</th>
                                        <th class="text-center">Alamat Email Ayah</th>
                                        <th class="text-center">Alamat</th>

                                        <th class="text-center">Nama Ibu</th>
                                        <th class="text-center">Tempat,Tanggal Lahir Ibu</th>
                                        <th class="text-center">Agama Ibu</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Pendidikan Terakhir Ibu</th>
                                        <th class="text-center">Pekerjaan Ibu</th>
                                        <th class="text-center">Nomor Telepon Ibu</th>
                                        <th class="text-center">Alamat Email Ibu</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orang_tuas as $orang_tua)
                                        <tr>
                                            <td class="text-center">{{$orang_tuas->firstItem() + $loop->index}}</td>
                                            <td class="text-center">{{$orang_tua->nama_ayah}}</td>
                                            <td class="text-center">{{$orang_tua->tempat_lahir_ayah}}, {{ \Carbon\Carbon::parse($orang_tua->tanggal_lahir_ayah)->translatedFormat('d F Y') }}</td>
                                            <td class="text-center">{{$orang_tua->agama_ayah}}</td>
                                            <td class="text-center">{{$orang_tua->jenis_kelamin_ayah}}</td>
                                            <td class="text-center">{{$orang_tua->pendidikan_terakhir_ayah}}</td>
                                            <td class="text-center">{{$orang_tua->pekerjaan_ayah}}</td>
                                            <td class="text-center">{{$orang_tua->nomor_telepon_ayah}}</td>
                                            <td class="text-center">{{$orang_tua->email}}</td>
                                            <td class="text-center">{{$orang_tua->alamat_ayah}}</td>

                                            <td class="text-center">{{$orang_tua->nama_ibu}}</td>
                                            <td class="text-center">{{$orang_tua->tempat_lahir_ibu}}, {{ \Carbon\Carbon::parse($orang_tua->tanggal_lahir_ibu)->translatedFormat('d F Y') }}</td>
                                            <td class="text-center">{{$orang_tua->agama_ibu}}</td>
                                            <td class="text-center">{{$orang_tua->jenis_kelamin_ibu}}</td>
                                            <td class="text-center">{{$orang_tua->pendidikan_terakhir_ibu}}</td>
                                            <td class="text-center">{{$orang_tua->pekerjaan_ibu}}</td>
                                            <td class="text-center">{{$orang_tua->nomor_telepon_ibu}}</td>
                                            <td class="text-center">{{$orang_tua->email1}}</td>
                                            <td class="text-center">{{$orang_tua->alamat_ibu}}</td>
                                            <td class="text-center">
                                                <div class="d-grid gap-2">
                                                    <a href="{{route('ortu.edit', $orang_tua->id)}}" class="btn btn-warning mr-2 mb-2">Edit</a>
                                                    <form action="{{route('ortu.hapus', $orang_tua->id)}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger mr-2 mb-2" value="Hapus">
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-12">
                                <div class="pagination-wrapper mt-3">
                                    {{$orang_tuas->links()}}
                                </div>
                            </div>

                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection