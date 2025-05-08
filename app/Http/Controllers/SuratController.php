<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\SuratIzinKeluarKelas;
use App\Models\SuratIzinKeluarSekolah;

class SuratController extends Controller
{
    public function index()
    {
        $suratTodayCount = SuratIzinKeluarKelas::whereDate('created_at', today())->count();
        $suratTodayCountSekolah = SuratIzinKeluarSekolah::whereDate('created_at', today())->count();
        return view('surat-izin.index', compact('suratTodayCount', 'suratTodayCountSekolah'));
    }

    public function createKeluarKelas()
    {
        $kelas = Kelas::all();
        $surat = SuratIzinKeluarKelas::whereDate('tanggal_surat', today())
            ->orderBy('created_at', 'desc') 
            ->get();
        $suratTerbaru = $surat->isNotEmpty() ? $surat->first() : null;
        $suratTerlama = $surat->isNotEmpty() ? $surat->last() : null;
        $jumlahSurat = $surat->count();
        return view('surat-izin.keluar-kelas.create', compact('kelas', 'surat', 'suratTerbaru', 'suratTerlama', 'jumlahSurat'));
    }

    public function storeKeluarKelas(Request $request)
    {
        $request->validate([
            'tanggal_surat' => 'required|date',
            'kepada_yth' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'jam_ke' => 'required|integer',
            'pesan_keluar_kelas' => 'required|string',
        ]);

        SuratIzinKeluarKelas::create([
            'tanggal_surat' => $request->tanggal_surat,
            'kepada_yth' => $request->kepada_yth,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'jam_ke' => $request->jam_ke,
            'pesan_keluar_kelas' => $request->pesan_keluar_kelas,
        ]);

        return redirect()->back()->with('success', 'Surat izin berhasil dibuat.');
    }

    public function showKeluarKelas($id)
    {
        $surat = SuratIzinKeluarKelas::with('kelas')->findOrFail($id);
        $suratHariIni = SuratIzinKeluarKelas::whereDate('tanggal_surat', today())
            ->orderBy('created_at', 'desc')
            ->get();

        $suratSebelumnya = $suratHariIni->filter(function ($item) use ($surat) {
            return $item->created_at < $surat->created_at;
        })->first();

        $suratBerikutnya = $suratHariIni->filter(function ($item) use ($surat) {
            return $item->created_at > $surat->created_at;
        })->last();

        return view('surat-izin.keluar-kelas.surat', compact('surat', 'suratHariIni', 'suratSebelumnya', 'suratBerikutnya'));
    }

    public function createKeluarSekolah()
    {
        $kelas = Kelas::all();
        $keluarSekolah = SuratIzinKeluarSekolah::whereDate('tanggal_surat', today())
            ->orderBy('created_at', 'desc')
            ->get();
        $suratTerbaru = $keluarSekolah->isNotEmpty() ? $keluarSekolah->first() : null;
        $suratTerlama = $keluarSekolah->isNotEmpty() ? $keluarSekolah->last() : null;
        $jumlahSurat = $keluarSekolah->count();

        return view('surat-izin.keluar-sekolah.create', compact('kelas', 'keluarSekolah', 'suratTerbaru', 'suratTerlama', 'jumlahSurat'));
    }

    public function storeKeluarSekolah(Request $request)
    {
        $request->validate([
            'tanggal_surat' => 'required|date',
            'kepada_yth' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'jam_ke' => 'required|integer',
            'pesan_keluar_sekolah' => 'required|string',
        ]);

        SuratIzinKeluarSekolah::create([
            'tanggal_surat' => $request->tanggal_surat,
            'kepada_yth' => $request->kepada_yth,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'jam_ke' => $request->jam_ke,
            'pesan_keluar_sekolah' => $request->pesan_keluar_sekolah,
        ]);
        return redirect()->back()->with('success', 'Surat izin berhasil dibuat.');
    }

    public function showKeluarSekolah($id)
{
    $keluarSekolah = SuratIzinKeluarSekolah::with('kelas')->findOrFail($id);
    $suratHariIni = SuratIzinKeluarSekolah::whereDate('tanggal_surat', today())
        ->orderBy('created_at', 'asc')
        ->get();

    $currentIndex = $suratHariIni->search(function ($item) use ($keluarSekolah) {
        return $item->id === $keluarSekolah->id;
    });

    $suratSebelumnya = $suratHariIni->get($currentIndex - 1);
    $suratBerikutnya = $suratHariIni->get($currentIndex + 1);

    $jumlahSurat = $suratHariIni->count();
    $kelas = Kelas::all();
    
    return view('surat-izin.keluar-sekolah.surat', compact('suratHariIni','keluarSekolah','suratSebelumnya','suratBerikutnya','jumlahSurat','kelas'));
}

}