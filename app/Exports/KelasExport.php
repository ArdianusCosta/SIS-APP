<?php

namespace App\Exports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KelasExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Kelas::with('waliKelas')->select('kelas', 'jurusan', 'wali_kelas_id')->get()->map(function ($kelas) {
            $kelas->wali_kelas = $kelas->waliKelas ? $kelas->waliKelas->nama : null;
            return $kelas;
        });
    }

    public function headings(): array
    {
        return [
            'Kelas', 'Jurusan', 'Wali Kelas'
        ];
    }
}
