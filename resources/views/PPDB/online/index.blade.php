@extends('layouts.main')

@php
    $title = 'PPDB-Online';
@endphp

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">PPDB-Online</h1>
          <form action="{{route('PPDBonline.index')}}" method="GET">
              <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="search" name="cari" class="form-control" placeholder="Cari Pendaftar..." aria-label="Search" value="{{request('cari')}}">
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
                        <h4>Data Nama PPDB-Online
                            <a href="{{route('PPDBonline.create')}}" class="btn btn-success float-right">Daftar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Foto profile</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Asal Sekolah Sebelumnya</th>
                                        <th class="text-center">Tanggal Mendaftar</th>
                                        <th class="text-center">Status Penerima</th>
                                        @auth
                                            @if (in_array(auth()->user()->role,['admin']))
                                                <th>Action</th>
                                            @endif
                                        @endauth
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ppdbs as $ppdb)
                                        <tr>
                                            <td class="text-center">{{$ppdbs->firstItem() + $loop->index}}</td>
                                            <td class="text-center">{{$ppdb->nama}}</td>
                                            <td class="text-center">
                                                @if ($ppdb->foto_pendaftar)
                                                    <img src="{{ asset('storage/' . $ppdb->foto_pendaftar) }}" width="50" height="50" class="rounded-circle" alt="Foto">
                                                @else
                                                    <span class="text-muted">Tidak Ada</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{$ppdb->tgl_lahir}}</td>
                                            <td class="text-center">{{$ppdb->jenis_kelamin}}</td>
                                            <td class="text-center">{{$ppdb->asal_sekolah_sebelumnya}}</td>
                                            <td class="text-center">{{$ppdb->tgl_pendaftaran}}</td>
                                            <td class="text-center text-bold">
                                                @if($ppdb->status == 'Disetujui')
                                                    <span class="badge badge-success">{{ $ppdb->status }}</span>
                                                @elseif($ppdb->status == 'Ditolak')
                                                    <span class="badge badge-danger">{{ $ppdb->status }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $ppdb->status }}</span>
                                                @endif
                                            </td>
                                            <td>   
                                            @auth
                                                @if (in_array(auth()->user()->role, ['admin']))
                                                <form action="{{route('PPDBonline.destroy',$ppdb->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </form>
                                                @endif
                                            @endauth                                                                                                                               <td class="text-center">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="col-12">
                                <div class="pagination-wrapper mt-3">
                                  {{ $ppdbs->links() }}
                                </div>
                              </div>                              

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection