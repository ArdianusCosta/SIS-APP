@extends('layouts.main')

@php
    $title = 'Edit Pengguna'
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
                        <h4>Edit Pengguna
                            <a href="{{route('user.index')}}" class="btn btn-success float-right">Kembali</a>
                        </h4>
                    </div>
                    <div class="card-body">
                      <form action="{{route('user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Nama</label>
                              <input type="text" name="name" class="form-control" required placeholder="Masukan nama pengguna..." value="{{$user->name}}">
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Email</label>
                              <input type="email" name="email" class="form-control" required placeholder="Masukan email pengguna..." value="{{$user->email}}">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Password</label>
                              <input type="text" name="password" class="form-control" placeholder="Masukan  password pengguna...">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label>Pilih Status Pengguna</label>
                              <select name="status" class="form-control">
                                <option value="">-- Pilih status pengguna --</option>
                                <option value="1" {{$user->status == 1 ? 'selected' : ''}}>Aktif</option>
                                <option value="0" {{$user->status == 0 ? 'selected' : ''}}>Dibanned</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-12 mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control">
                              <option value="">-- Pilih Role --</option>
                              <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                              <option value="guru" {{ old('role', $user->role ?? '') == 'guru' ? 'selected' : '' }}>Guru</option>
                              <option value="murid" {{ old('role', $user->role ?? '') == 'murid' ? 'selected' : '' }}>Murid</option>
                            </select>
                          </div>

                          <div class="col-12 mt-3 text-center">
                            <button type="submit" class="btn btn-primary">Edit</button>
                          </div>

                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection