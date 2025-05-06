<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class GuruExport implements FromCollection, WithHeadings, WithDrawings
{
    private $gurus;

    public function __construct()
    {
        $this->gurus = Guru::select(
            'nama', 'status', 'jabatan', 'nik', 'pendidikan', 'mata_pelajaran',
            'jenis_kelamin', 'agama', 'tempat_lahir', 'tanggal_lahir', 'alamat',
            'email', 'no_telepon', 'img'
        )->get();
    }

    public function collection()
{
    return $this->gurus->map(function ($guru) {
        return collect($guru)->except('img');
    });
}


public function headings(): array
{
    return [
        'nama', 'status', 'jabatan', 'nik', 'pendidikan', 'mata_pelajaran',
        'jenis_kelamin', 'agama', 'tempat_lahir', 'tanggal_lahir', 'alamat',
        'email', 'no_telepon'
    ];
}


    public function drawings()
    {
        $drawings = [];
        $row = 2; 

        foreach ($this->gurus as $guru) {
            if ($guru->img && file_exists(public_path('storage/' . $guru->img))) {
                $drawing = new Drawing();
                $drawing->setName($guru->nama);
                $drawing->setDescription('Foto Guru');
                $drawing->setPath(public_path('storage/' . $guru->img));
                $drawing->setHeight(60);
                $drawing->setCoordinates('O' . $row); 
                $drawings[] = $drawing;
            }
            $row++;
        }

        return $drawings;
    }
}
