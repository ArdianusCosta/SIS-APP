@extends('layouts.main')

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Manajement Kelas</h1>
          <form action="{{route('kelas.index')}}" method="GET">
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
                        <h4>List Kelas
                            <a href="{{route('kelas.create')}}" class="btn btn-success float-right">Tambah Data Kelas</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Wali Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $kela)
                                    <tr>
                                        <td>{{ $kelas->firstItem() + $loop->index }}</td>
                                        <td>{{$kela->kelas}}</td>
                                        <td>{{ $kela->jurusan }}</td>
                                        <td>{{ $kela->waliKelas->nama ?? '-' }}</td>
                                        <td class="text-center">
                                            <div class="d-grid gap-2">
                                                <a href="#" class="btn btn-warning mr-2 mb-2">Edit</a>
                                                <form action="#" method="post">
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
                                    {{$kelas->links()}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection