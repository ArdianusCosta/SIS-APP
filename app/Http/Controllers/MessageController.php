<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Mail\KirimEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function create()
    {
        return view('email.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required',
            'email' => 'nullable|email',
            'pesan' => 'required',
            'file' => 'nullable|file|max:10240',
        ]);

        $path = null;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('email', 'public');
        }

        $message = Message::create([
            'nama_pengirim' => $request->nama_pengirim,
            'email' => $request->email,
            'pesan' => $request->pesan,
            'file' => $path,
        ]);

        if ($request->filled('email')) {
            Mail::to($request->email)->send(
                new KirimEmail($message->nama_pengirim, $message->pesan, $message->file ? url('download/' . basename($message->file)) : null)
            );                    } else {
            $users = User::all();
            foreach ($users as $user) {
                Mail::to($user->email)->send(new KirimEmail($message, $user));
            }
        }

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function download($filename)
    {
        $path = storage_path('app/public/email/' . $filename);
        if (!file_exists($path)) {
            abort(404); 
        }
        return response()->download($path);
    }

}
    