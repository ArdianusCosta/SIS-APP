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
            {{ $guru->jabatan }}
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
                    No HP: {{ $guru->no_telepon ?? '-' }}
                  </li>
                </ul>
              </div>
              <div class="col-5 text-center">
                <img 
                  src="{{ asset('storage/' . $guru->img) }}" 
                  alt="Foto Guru" 
                  class="img-fluid rounded-circle border" 
                  style="width: 128px; height: 128px; object-fit: cover; border-radius: 50%;"
                >
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="text-right">
              <a href="mailto:{{ $guru->email }}" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
              </a>
              <button 
                type="button" 
                class="btn btn-sm btn-primary" 
                data-toggle="modal" 
                data-target="#profileModal{{ $guru->id }}"
              >
                <i class="fas fa-user"></i> View Profile
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="profileModal{{ $guru->id }}" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel{{ $guru->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="profileModalLabel{{ $guru->id }}">Profil {{ $guru->nama }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="text-center mb-3">
                <img 
                  src="{{ asset('storage/' . $guru->img) }}" 
                  alt="Foto Guru" 
                  class="img-fluid rounded-circle border" 
                  style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;"
                >
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nama:</strong> {{ $guru->nama }}</li>
                <li class="list-group-item"><strong>Jabatan:</strong> {{ $guru->jabatan ?? '-' }}</li>
                <li class="list-group-item"><strong>Alamat:</strong> {{ $guru->alamat ?? '-' }}</li>
                <li class="list-group-item"><strong>No Telepon:</strong> {{ $guru->no_telepon ?? '-' }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $guru->email ?? '-' }}</li>
                <!-- Tambahkan field lain jika ada, misalnya -->
                <!-- <li class="list-group-item"><strong>Tentang Saya:</strong> {{ $guru->about_me ?? '-' }}</li> -->
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection