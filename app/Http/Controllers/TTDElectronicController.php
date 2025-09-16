<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TTDElectronicController extends Controller
{
    public function index()
    {
        return view('sertifikasi.ttd-electronik.index');
    }

    public function store(Request $request)
    {
        if ($request->filled('signature')) {
            $folderPath = public_path('uploads/signatures/');

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $image_parts = explode(";base64,", $request->signature);
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';
            $file = $folderPath . $fileName;    

            file_put_contents($file, $image_base64);

            return redirect()->route('ttd-electronik.index')
                             ->with('success', 'Tanda tangan berhasil disimpan: ' . $fileName);
        }

        return redirect()->route('ttd-electronik.index')
                         ->with('error', 'Tanda tangan tidak ditemukan.');
    }
}
