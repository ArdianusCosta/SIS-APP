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

                    <form action="#" method="get">
                        <div class="container-fluid py-3" style="background-color : #343536">
                            <div class="row">
                                @php
                                    $date_start = request('date_start') ?? \Carbon\Carbon::parse($firstDate)->format('Y-m-d');
                                @endphp
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date_start" value="{{ $date_start }}" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date_end" value="{{ request('date_end') }}" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="jabatan" class="form-control">
                                        <option value="">-- Filter Jabatan --</option>
                                        <option value="Guru" {{request('jabatan') == 'Guru' ? 'selected' : ''}}>Guru</option>
                                        <option value="Staff" {{request('jabatan') == 'Staff' ? 'selected' : ''}}>Staff</option>
                                        <option value="Kepala Sekolah" {{request('jabatan') == 'Kepala Sekolah' ? 'selected' : ''}}>Kepala Sekolah</option>
                                        <option value="Yayasan" {{request('jabatan') == 'Yayasan' ? 'selected' : ''}}>Yayasan</option>
                                        <option value="Ketua Yayasan" {{request('jabatan') == 'Ketua Yayasan' ? 'selected' : ''}}>Ketua Yayasan</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="status" class="form-control">
                                        <option value="">-- Filter Status --</option>
                                        <option value="Aktif" {{request('status') == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                        <option value="Tidak Aktif" {{request('status') == 'Tidak Aktif' ? 'selected' : ''}}>Tidak Aktif</option>
                                        <option value="Magang" {{request('status') == 'Magang' ? 'selected' : ''}}>Magang</option>
                                        <option value="Cuti" {{request('status') == 'Cuti' ? 'selected' : ''}}>Cuti</option>
                                        <option value="Pensiun" {{request('status') == 'Pensiun' ? 'selected' : ''}}>Pensiun</option>
                                        <option value="Keluar" {{request('status') == 'Keluar' ? 'selected' : ''}}>Keluar</option>
                                        <option value="Dikeluarkan" {{request('status') == 'Dikeluarkan' ? 'selected' : ''}}>Dikeluarkan</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="agama" class="form-control">
                                        <option value="">-- Filter Agama --</option>
                                        <option value="Islam" {{request('agama') == 'Islam' ? 'selected' : ''}}>Islam</option>
                                        <option value="Kristen" {{request('agama') == 'Kristen' ? 'selected' : ''}}>Kristen </option>
                                        <option value="Katolik" {{request('agama') == 'Katolik' ? 'selected' : ''}}>Katolik </option>
                                        <option value="Hindu" {{request('agama') == 'Hindu' ? 'selected' : ''}}>Hindu </option>
                                        <option value="Buddha" {{request('agama') == 'Buddha' ? 'selected' : ''}}>Buddha </option>
                                        <option value="Konghucu" {{request('agama') == 'Konghucu' ? 'selected' : ''}}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="submit" class="btn btn-warning btn-block">Filter</button>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <a href="{{route('guru.export')}}" class="btn btn-warning btn-block">EXPORT</a>
                                </div>

                                <div class="col-md-2 mb-2">
                                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModalCenter">IMPORT</a>
                                     <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Import Data Guru</h5>
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
                                    <th class="text-center">No</th>
                                    <th class="text-center">Foto Guru</th>
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
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Nomor Telepon Guru</th>
                                    <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $guru)
                                        <tr>
                                            <td class="text-center">{{$gurus->firstItem() + $loop->index}}</td>
                                            <td class="text-center">
                                                @if ($guru->img)
                                                    <img 
                                                        src="{{ asset('storage/' . $guru->img) }}" 
                                                        alt="Foto Guru" 
                                                        width="64" 
                                                        height="64" 
                                                        style="object-fit: cover; border-radius: 50%;">
                                                @else
                                                    <span>Tidak ada foto</span>
                                                @endif
                                            </td>                                                                                                    
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
                                            <td class="text-center">{{$guru->email}}</td>
                                            <td class="text-center">{{$guru->no_telepon}}</td>
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
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection