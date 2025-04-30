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
                    
                    <form action="" method="get">
                        <div class="container-fluid p-3" style="background-color: #343536">
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date_start" value="{{ request('date_start') }}" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="date" name="date_end" value="{{ request('date_end') }}" class="form-control">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="kelas" class="form-control">
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="X" {{ request('kelas') == 'X' ? 'selected' : '' }}>Kelas X</option>
                                        <option value="XI" {{ request('kelas') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                                        <option value="XII" {{ request('kelas') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="jurusan" class="form-control">
                                        <option value="">-- Pilih Jurusan --</option>
                                        <option value="RPL" {{ request('jurusan') == 'RPL' ? 'selected' : ''}}>RPL</option>
                                        <option value="DKV" {{request('jurusan') == 'DKV' ? 'selected' : ''}}>DKV</option>
                                        <option value="KULINER" {{request('jurusan') == 'KULINER' ? 'selected' : ''}}>KULINER</option>
                                        <option value="TP" {{request('jurusan') == 'TP' ? 'selected' : ''}}>TP</option>
                                        <option value="TKP" {{request('jurusan') == 'TKP' ? 'selected' : ''}}>TKP</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="submit" class="btn btn-warning btn-block">Periksa</button>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <a href="#" class="btn btn-warning btn-block">EXPORT EXCEL</a>
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
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Jurusan</th>
                                        <th class="text-center">Wali Kelas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $kela)
                                    <tr>
                                        <td class="text-center">{{ $kelas->firstItem() + $loop->index }}</td>
                                        <td class="text-center">{{$kela->kelas}}</td>
                                        <td class="text-center">{{ $kela->jurusan }}</td>
                                        <td class="text-center">{{ $kela->waliKelas->nama ?? '-' }}</td>
                                        <td class="text-center">
                                            <div class="d-grid gap-2">
                                                <a href="{{route('kelas.edit', $kela->id)}}" class="btn btn-warning mr-2 mb-2">Edit</a>
                                                <a href="#" class="btn btn-info mr-2 mb-2">
                                                    <i class="bi bi-eye"></i>
                                                </a>                                                
                                                <form action="{{route('kelas.destroy', $kela->id)}}" method="post">
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
                                    {{$kelas->links()}}
                                </div>
                            </div>

                        </div>
                        {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection