<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AbsensiController extends Controller
{
    public function list()
    {
        return view('absensi.list');
    }

    public function cariSiswa(Request $request)
    {
        $cari = $request->get('query');
        $siswa = Siswa::where('nama', 'LIKE', "%{$cari}%")->get(['id','nama']);
        return response()->json($siswa);
    }

    public function create(Request $request)
    {
        $kelas = Kelas::all();
        $absensis = Absensi::all();
        return view('absensi.input.create',compact('kelas','absensis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_waktu' => 'required',
            'status_kehadiran' => 'required|in:Hadir,Sakit,Izin,Alpha',
            'keterangan' => 'nullable',
        ]);

        $tanggal = Carbon::parse($request->tanggal_waktu)->format('Y-m-d');

        $sudahAbsen = Absensi::where('siswa_id', $request->siswa_id)
        ->whereDate('tanggal_waktu', $tanggal)
        ->exists();

        if($sudahAbsen){
            return back()->with('error','Siswa sudah absen hari ini!');
        }

        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'tanggal_waktu' => $request->tanggal_waktu,
            'status_kehadiran' => $request->status_kehadiran,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success','Absensi Berhasil');
    }

    public function indexScan()
    {
        return view('absensi.scan.index-scan');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'link' => 'required|url',
        ]);

        $uid = time();
        $qr = QrCode::format('png')->generate($request->link);
        $qrImageName = $uid . '.png';

        Storage::put('public/qr/' . $qrImageName, $qr);

        return view('absensi.scan.scan-qrcode', compact('uid'));
    }

    public function scanQrcode()
    {
        return view('absensi.scan.scan-kamera');
    }
}
