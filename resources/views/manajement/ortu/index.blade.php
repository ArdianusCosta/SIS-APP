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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ayah</th>
                                        <th>Tempat, Tanggal Lahir Ayah</th>
                                        <th>Agama Ayah</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Pendidikan Terakhir Ayah</th>
                                        <th>Pekerjaan Ayah</th>
                                        <th>Nomor Telepon Ayah</th>
                                        <th>Alamat Email Ayah</th>
                                        <th>Alamat</th>

                                        <th>Nama Ibu</th>
                                        <th>Tempat,Tanggal Lahir Ibu</th>
                                        <th>Agama Ibu</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Pendidikan Terakhir Ibu</th>
                                        <th>Pekerjaan Ibu</th>
                                        <th>Nomor Telepon Ibu</th>
                                        <th>Alamat Email Ibu</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orang_tuas as $orang_tua)
                                        <tr>
                                            <td>{{$orang_tuas->firstItem() + $loop->index}}</td>
                                            <td>{{$orang_tua->nama_ayah}}</td>
                                            <td>{{$orang_tua->tempat_lahir_ayah}}, {{ \Carbon\Carbon::parse($orang_tua->tanggal_lahir_ayah)->translatedFormat('d F Y') }}</td>
                                            <td>{{$orang_tua->agama_ayah}}</td>
                                            <td>{{$orang_tua->jenis_kelamin_ayah}}</td>
                                            <td>{{$orang_tua->pendidikan_terakhir_ayah}}</td>
                                            <td>{{$orang_tua->pekerjaan_ayah}}</td>
                                            <td>{{$orang_tua->nomor_telepon_ayah}}</td>
                                            <td>{{$orang_tua->email}}</td>
                                            <td>{{$orang_tua->alamat_ayah}}</td>

                                            <td>{{$orang_tua->nama_ibu}}</td>
                                            <td>{{$orang_tua->tempat_lahir_ibu}}, {{ \Carbon\Carbon::parse($orang_tua->tanggal_lahir_ibu)->translatedFormat('d F Y') }}</td>
                                            <td>{{$orang_tua->agama_ibu}}</td>
                                            <td>{{$orang_tua->jenis_kelamin_ibu}}</td>
                                            <td>{{$orang_tua->pendidikan_terakhir_ibu}}</td>
                                            <td>{{$orang_tua->pekerjaan_ibu}}</td>
                                            <td>{{$orang_tua->nomor_telepon_ibu}}</td>
                                            <td>{{$orang_tua->email1}}</td>
                                            <td>{{$orang_tua->alamat_ibu}}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection