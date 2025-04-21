@extends('layouts.main')

@php
    $title = 'Kirim Ke Pengguna'
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Kirim Ke Pengguna</h1>
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
          <h4>Kirim Email</h4>
        </div>
        <div class="card-body">
          <form action="{{route('email.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label>Nama Pengirim (nama anda)</label>
                  <input type="text" name="nama_pengirim" class="form-control" required placeholder="Masukan nama anda...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label>Email Penerima (email yang dituju)</label>
                  <input type="email" name="email" class="form-control" required placeholder="Masukan email penerima...">
                </div>
              </div>
              <div class="col-md-12">
                <div class="mb-3">
                  <label>File (file yang ingin dikirim)</label>
                  <input type="file" name="file" class="form-control">
                </div>
              </div>
              <div class="col-md-12">
                <div class="mb-3">
                  <label>Pesan (pesan yang ingin dikirim ke penerima)</label>
                  <textarea name="pesan" required class="form-control" rows="5" placeholder="Masukan pesan yang ingin anda kirim..."></textarea>
                </div>
              </div>
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
