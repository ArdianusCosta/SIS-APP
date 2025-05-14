<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use App\Models\ContactCosta;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('.contact_to_speatseed.index-spreatseed');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'phone' => 'required|unique:contact_costas,phone',
            'email' => 'required|email',
            'pesan_to_costa' => 'required',
        ]);
        ContactCosta::create([
            'nama' => $request->nama,
            'phone' => $request->phone,
            'email' => $request->email,
            'pesan_to_costa' => $request->pesan_to_costa,
        ]);

        return back()->with('success','Berhasil kirim pesan ke developer');
    }
}
