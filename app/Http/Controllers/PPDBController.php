<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Models\PpdbNotifikasi;
use App\Models\PPDBRegistrasi;
use App\Mail\PPDBStatusNotifikasi;
use Illuminate\Support\Facades\Mail;
use App\Services\TwilioWhatsappService;

class PPDBController extends Controller
{
    public function index()
    {
        $ppdbs = PPDBRegistrasi::whereIn('status',['Disetujui','Ditolak'])->paginate(5);
        return view('PPDB.online.index',compact('ppdbs'));
    }

    public function create()
    {
        return view('PPDB.online.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto_pendaftar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'nisn' => 'required',
            'nik' => 'required',
            'email' => 'nullable|email',
            'no_telp' => 'nullable|string|max:20',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable',
            'asal_sekolah_sebelumnya' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'tgl_pendaftaran' => 'required|date',
            'status' => 'Tertunda',
        ]);
        $fotoPath = null;
        if($request->hasFile('foto_pendaftar')){
            $fotoPath = $request->file('foto_pendaftar')->store('PPDB-Online','public');
        };
       $ppdb = PPDBRegistrasi::create([
                'nama' => $request->nama,
                'foto_pendaftar' => $fotoPath,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'email' => $request->email,
                'no_telp' => $this->formatNomorWa($request->no_telp),
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'asal_sekolah_sebelumnya' => $request->asal_sekolah_sebelumnya,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tgl_pendaftaran' => $request->tgl_pendaftaran,
                'status' => $request->status,
        ]);
            PpdbNotifikasi::create([
            'ppdb_id' => $ppdb->id,
            'message' => "Pendaftar baru: {$ppdb->nama} telah mendaftar PPDB.",
            'is_read' => false,
        ]);

        return redirect()->route('PPDBonline.index')->with('success','Berhasil Daftar Silankan tunggu informasi lewat status yang akan diupdate disini');
    }

    public function destroy($id)
    {
        $ppdbs = PPDBRegistrasi::findOrFail($id);

        if($ppdbs->foto_pendaftar && \Storage::disk('public')->exists($ppdbs->foto_pendaftar)){
            \Storage::disk('public')->delete($ppdbs->foto_pendaftar);
        }

        $ppdbs->delete();
        return back()->with('success','Berhasil hapus data');
    }

    public function adminIndex()
    {
        $ppdbs = PPDBRegistrasi::paginate(5); 
        return view('PPDB.status.index-admin', compact('ppdbs'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Ditolak,Tertunda,Disetujui',
        ]);
    
        $ppdb = PPDBRegistrasi::findOrFail($id);
        $ppdb->status = $request->status;
        $ppdb->save();
    
        if ($ppdb->email && in_array($ppdb->status, ['Ditolak', 'Disetujui'])) {
            Mail::to($ppdb->email)->send(new PPDBStatusNotifikasi($ppdb));
        }
    
        // if ($ppdb->no_telp && in_array($ppdb->status, ['Ditolak', 'Disetujui'])) {
        //     $pesan = "Halo {$ppdb->nama}, status pendaftaran PPDB Anda adalah *{$ppdb->status}*.\n\nTerima kasih telah mendaftar 🙏";
    
        //     $wa = new TwilioWhatsappService();
        //     $wa->sendMessage($ppdb->no_telp, $pesan);
        // }
    
        return back()->with('success', 'Status berhasil diperbarui dan notifikasi telah dikirim.');
    }    

    public function baca($id)
    {
        $notif = PpdbNotifikasi::findOrFail($id);

        if (!$notif->is_read) {
            $notif->is_read = 1;
            $notif->save();
        }

        return redirect()->route('PPDBonline.index')->with('success', 'Notifikasi dibaca');
    }

    private function formatNomorWa($nomor)
    {
        $nomor = preg_replace('/[^0-9]/', '', $nomor);

        if (strpos($nomor, '62') === 0) {
            return '+' . $nomor;
        } elseif (strpos($nomor, '0') === 0) {
            return '+62' . substr($nomor, 1);
        }

        return '+62' . $nomor; 
    }

}
