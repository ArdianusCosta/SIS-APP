@extends('layouts.main')

@php
    $title = 'Absensi-Input'
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="m-0">Absensi-Input</h1>
          <form action="{{ route('absensi.index') }}" method="GET">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Absensi-Input
                            <a href="" class="btn btn-success float-right">Tambah Data</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection