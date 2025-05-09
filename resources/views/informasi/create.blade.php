@extends('layouts.main')

@section('content')
<div class="card-body">
    <h5 class="mb-2">Buat Informasi & Penggumuman
        <a href="{{route('informasi.index')}}" class="btn btn-success float-right">Kembali</a>
    </h5>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-3">
                            <label>Judul<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required="required" placeholder="Masukan judul...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection