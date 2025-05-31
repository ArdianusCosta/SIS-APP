@extends('layouts.main')

@section('content')
@include('layouts.inc.alert')
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-header">
                <h4>List Data Pendaftar</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Ubah Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ppdbs as $ppdb)
                            <tr>
                                <td>{{$ppdbs->firstItem() + $loop->index}}</td>
                                <td>{{ $ppdb->nama }}</td>
                                <td>
                                    @if ($ppdb->status == 'Disetujui')
                                        <span class="badge badge-success">{{ $ppdb->status }}</span>
                                    @elseif ($ppdb->status == 'Ditolak')
                                        <span class="badge badge-danger">{{ $ppdb->status }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $ppdb->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal{{ $ppdb->id }}">
                                        Detail
                                    </button>
                                </td>
                                <td>
                                    <form action="{{ route('admin.ppdb.update', $ppdb->id) }}" method="POST">
                                        @csrf
                                        <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                            <option value="Tertunda" {{ $ppdb->status == 'Tertunda' ? 'selected' : '' }}>Tertunda</option>
                                            <option value="Ditolak" {{ $ppdb->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            <option value="Disetujui" {{ $ppdb->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="col-12">
                    <div class="pagination-wrapper mt-3">
                      {{ $ppdbs->links() }}
                    </div>
                  </div>                        


                @foreach ($ppdbs as $ppdb)
                    <div class="modal fade" id="detailModal{{ $ppdb->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $ppdb->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="detailModalLabel{{ $ppdb->id }}">Detail Pendaftar: {{ $ppdb->nama }}</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-md-4 text-center mb-3">
                                        <img src="{{ asset('storage/'.$ppdb->foto_pendaftar) }}" alt="Foto {{ $ppdb->nama }}" class="img-fluid rounded shadow" style="max-height: 200px;">
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>No</th>
                                                <td>: {{$ppdbs->firstItem() + $loop->index}}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td>: {{ $ppdb->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>NISN</th>
                                                <td>: {{ $ppdb->nisn }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIK</th>
                                                <td>: {{ $ppdb->nik }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>: {{ $ppdb->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>No Telp</th>
                                                <td>: {{ $ppdb->no_telp }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tempat Lahir</th>
                                                <td>: {{ $ppdb->tempat_lahir }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Lahir</th>
                                                <td>: {{ $ppdb->tgl_lahir }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td>: {{ $ppdb->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>: {{ $ppdb->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Asal Sekolah</th>
                                                <td>: {{ $ppdb->asal_sekolah_sebelumnya }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Ayah</th>
                                                <td>: {{ $ppdb->nama_ayah }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Ibu</th>
                                                <td>: {{ $ppdb->nama_ibu }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Daftar</th>
                                                <td>: {{ $ppdb->tgl_pendaftaran }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>: 
                                                    @if ($ppdb->status == 'Disetujui')
                                                        <span class="badge badge-success">{{ $ppdb->status }}</span>
                                                    @elseif ($ppdb->status == 'Ditolak')
                                                        <span class="badge badge-danger">{{ $ppdb->status }}</span>
                                                    @else
                                                        <span class="badge badge-warning">{{ $ppdb->status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
