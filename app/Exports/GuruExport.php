<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class GuruExport implements FromCollection, WithHeadings, WithDrawing
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Guru::select('nama', 'status', 'jabatan', 'nik', 'pendidikan', 'mata_pelajaran', 
                            'jenis_kelamin', 'agama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 
                            'email', 'no_telepon', 'img')
                    ->get()
                    ->map(function ($guru) {
                        // Menambahkan URL gambar jika ada
                        $guru->img = $guru->img ? asset('storage/' . $guru->img) : null;
                        return $guru;
                    });
    }

    /**
     * Menambahkan Heading pada export Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama', 
            'Status', 
            'Jabatan', 
            'NIK', 
            'Pendidikan', 
            'Mata Pelajaran', 
            'Jenis Kelamin', 
            'Agama', 
            'Tempat Lahir', 
            'Tanggal Lahir', 
            'Alamat', 
            'Email', 
            'No Telepon', 
            'Foto'
        ];
    }

    /**
     * Menambahkan gambar pada file Excel
     *
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Drawing
     */
    public function drawing()
    {
        // Pastikan gambar ada di storage
        $drawing = new Drawing();
        $drawing->setName('Guru Image');
        $drawing->setDescription('Gambar Foto Guru');
        $drawing->setPath(public_path('storage/guru-image.jpg')); // Path gambar di server
        $drawing->setHeight(100); // Ukuran gambar
        $drawing->setCoordinates('O2'); // Posisi gambar di Excel

        return $drawing;
    }
}
