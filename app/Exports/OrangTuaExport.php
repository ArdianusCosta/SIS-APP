<?php

namespace App\Exports;

use App\Models\OrangTua;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrangTuaExport implements FromCollection, WithHeadings
{
    /**
    * 
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrangTua::select(
            'nama_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'agama_ayah', 'jenis_kelamin_ayah',
            'pendidikan_terakhir_ayah', 'pekerjaan_ayah', 'nomor_telepon_ayah', 'email', 'alamat_ayah',
            'nama_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'agama_ibu', 'jenis_kelamin_ibu',
            'pendidikan_terakhir_ibu', 'pekerjaan_ibu', 'nomor_telepon_ibu', 'email1', 'alamat_ibu'
        )->get();
    }

    /**
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'nama_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'agama_ayah', 'jenis_kelamin_ayah',
            'pendidikan_terakhir_ayah', 'pekerjaan_ayah', 'nomor_telepon_ayah', 'email', 'alamat_ayah',
            'nama_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'agama_ibu', 'jenis_kelamin_ibu',
            'pendidikan_terakhir_ibu', 'pekerjaan_ibu', 'nomor_telepon_ibu', 'email1', 'alamat_ibu'
        ];
    }
}
