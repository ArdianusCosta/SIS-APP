@extends('layouts.main')

@php
$title = 'Guru'; 
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Manajement Guru</h1>
          <form action="{{ route('guru.index') }}" method="GET">
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
                        <h4>List Guru
                            <a href="{{route('guru.create')}}" class="btn btn-success float-right">Tambah Guru</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Nomor Induk Karyawan</th>
                                    <th class="text-center">Pendidikan</th>
                                    <th class="text-center">Mata Pelajaran</th>
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Agama</th>
                                    <th class="text-center">Tempat, tanggal Lahir</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $guru)
                                        <tr>
                                            <td>{{$gurus->firstItem() + $loop->index}}</td>
                                            <td class="text-center">{{$guru->nama}}</td>
                                            <td class="text-center">{{$guru->status}}</td>
                                            <td class="text-center">{{$guru->jabatan}}</td>
                                            <td class="text-center">{{$guru->nik}}</td>
                                            <td class="text-center">{{$guru->pendidikan}}</td>
                                            <td class="text-center">{{$guru->mata_pelajaran}}</td>
                                            <td class="text-center">{{$guru->jenis_kelamin}}</td>
                                            <td class="text-center">{{$guru->agama}}</td>
                                            <td class="text-center">{{ $guru->tempat_lahir }}, {{ \Carbon\Carbon::parse($guru->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                            {{-- <td>{{$guru->tanggal_lahir}}</td> --}}
                                            <td class="text-center">{{$guru->alamat}}</td>
                                            <td class="text-center">
                                                <div class="d-grid gap-2">
                                                    <a href="{{route('guru.edit', $guru->id)}}" class="btn btn-warning mr-2 mb-2">Edit</a>
                                                    <form action="{{route('guru.hapus', $guru->id)}}" method="post" enctype="multipart/form-data">
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
                                    {{$gurus->links()}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection