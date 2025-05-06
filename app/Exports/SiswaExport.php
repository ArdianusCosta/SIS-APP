<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class SiswaExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return Siswa::with(['kelas', 'waliKelas'])->get()->map(function ($siswa) {
            return [
                'nama' => $siswa->nama,
                'kelas' => optional($siswa->kelas)->kelas ?? '-',
                'jurusan' => optional($siswa->kelas)->jurusan ?? '-',
                'wali_kelas' => optional($siswa->waliKelas)->nama ?? '-',
                'tempat_lahir' => $siswa->tempat_lahir,
                'tanggal_lahir' => $siswa->tanggal_lahir,
                'jenis_kelamin' => $siswa->jenis_kelamin,
                'nis' => $siswa->nis,
                'agama' => $siswa->agama,
                'jumlah_saudara' => $siswa->jumlah_saudara,
                'email' => $siswa->email,
                'no_telepon' => $siswa->no_telepon,
                'qrcode' => $siswa->qrcode,
                'alamat' => $siswa->alamat,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kelas',
            'Jurusan',
            'Wali Kelas',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'NIS',
            'Agama',
            'Jumlah Saudara',
            'Email',
            'No Telepon',
            'QR Code',
            'Alamat',
        ];
    }
}
