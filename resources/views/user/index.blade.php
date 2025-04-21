@extends('layouts.main')

@php
    $title = 'Pengguna'
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Pengguna</h1>
          <form action="{{ route('user.index') }}" method="GET">
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
                        <h4>List Pengguna
                            <a href="{{route('user.create')}}" class="btn btn-success float-right">Tambah Pengguna</a>
                        </h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Status</th>
                              <th>Role</th>
                              <th class="text-center">Aksi</th>
                            </tr>
                          </thead>

                          <tbody>
                            @foreach ($users as $user)  
                            <tr>
                              <td>{{$users->firstItem() + $loop->index}}</td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{$user->status ? 'Aktif' : 'Dibanned'}}</td>
                              <td>{{$user->role}}</td>
                              <td class="text-center">
                                <div class="d-grid gap-2">
                                  <a href="{{route('user.edit', $user->id)}}" class="btn btn-warning mr-2 mb-2">Edit</a>
                                  <form action="{{route('user.hapus', $user->id)}}" method="post">
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
                            {{ $users->links() }}
                          </div>
                        </div>                        

                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection