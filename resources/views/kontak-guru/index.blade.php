@extends('layouts.main')

@php
    $title = 'Kontak Guru';
@endphp

@section('content-header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Kontak Guru</h1>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="card card-solid">
  <div class="card-body pb-0">
    <div class="row">
      @foreach ($gurus as $guru)
      <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0">
            {{$guru->jabatan}}
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-7">
                <h2 class="lead"><b>{{ $guru->nama }}</b></h2>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small">
                    <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                    Alamat: {{ $guru->alamat ?? '-' }}
                  </li>
                  <li class="small">
                    <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                    No HP #: {{ $guru->no_telepon ?? '-' }}
                  </li>
                </ul>
              </div>
              <div class="col-5 text-center">
                <img 
                src="{{ asset('storage/' . $guru->img)}}" 
                alt="Foto Guru" 
                class="img-fluid rounded-circle"
                style="width: 128px; height: 128px; object-fit: cover;">
                </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="mailto:{{ $guru->email }}" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> View Profile
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
