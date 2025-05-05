<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            'nama' => $row[1],
            'kelas_id' => $row[2],
            'wali_kelas_id' => $row[3],
            'tempat_lahir' => $row[4],
            'tanggal_lahir' => $row[5],
            'jenis_kelamin' => $row[6],
            'nis' => $row[7],
            'agama' => $row[8],
            'jumlah_saudara' => $row[9],
            'email' => $row[10],
            'no_telepon' => $row[11],
            'alamat' => $row[12],
        ]);
    }
}
