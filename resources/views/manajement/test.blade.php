@extends('layouts.main')

@php
$title = 'List-app'; 
@endphp

@section('content-header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>List Test</h1>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>List Test
            <a href="#" class="btn btn-primary float-right">Tambah Data</a>
          </h4>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

