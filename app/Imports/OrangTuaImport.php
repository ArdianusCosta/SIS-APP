<?php

namespace App\Imports;

use App\Models\OrangTua;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrangTuaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new OrangTua([
            'nama_ayah' => $row['nama_ayah'],
            'tempat_lahir_ayah' => $row['tempat_lahir_ayah'],
            'tanggal_lahir_ayah' => $row['tanggal_lahir_ayah'],
            'agama_ayah' => $row['agama_ayah'],
            'jenis_kelamin_ayah' => $row['jenis_kelamin_ayah'],
            'pendidikan_terakhir_ayah' => $row['pendidikan_terakhir_ayah'],
            'pekerjaan_ayah' => $row['pekerjaan_ayah'],
            'nomor_telepon_ayah' => $row['nomor_telepon_ayah'],
            'email' => $row['email'],
            'alamat_ayah' => $row['alamat_ayah'],
            'nama_ibu' => $row['nama_ibu'],
            'tempat_lahir_ibu' => $row['tempat_lahir_ibu'],
            'tanggal_lahir_ibu' => $row['tanggal_lahir_ibu'],
            'agama_ibu' => $row['agama_ibu'],
            'jenis_kelamin_ibu' => $row['jenis_kelamin_ibu'],
            'pendidikan_terakhir_ibu' => $row['pendidikan_terakhir_ibu'],
            'pekerjaan_ibu' => $row['pekerjaan_ibu'],
            'nomor_telepon_ibu' => $row['nomor_telepon_ibu'],
            'email1' => $row['email1'],
            'alamat_ibu' => $row['alamat_ibu'],
        ]);
    }
}
