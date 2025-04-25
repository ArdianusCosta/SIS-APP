@extends('layouts.main')

@php
    $title = 'Buat Pengguna'
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Pengguna</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Pengguna
                            <a href="{{route('user.index')}}" class="btn btn-success float-right">Kembali</a>
                        </h4>
                    </div>
                    <div class="card-body">
                      @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                      <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Nama</label>
                              <input type="text" name="name" class="form-control" required placeholder="Masukan nama pengguna...">
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control" required placeholder="Masukan email pengguna...">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Password</label>
                              <input type="text" name="password" class="form-control" required placeholder="Masukan  password pengguna...">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Pilih Status Pengguna</label>
                              <select name="status" class="form-control">
                                <option value="">-- Pilih status pengguna --</option>
                                <option value="1">Aktif</option>
                                <option value="0">Dibanned</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Role</label>
                              <select name="role" class="form-control">
                                <option value="">-- Pilih role pengguna --</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="murid">Murid</option>
                              </select> 
                          </div>

                          <div class="col-12 mt-3 text-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>

                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection