<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $login = $request->only('email','password');

        if(Auth::attempt($login)){
            $user = Auth::user();
            if($user->status == 0){
                Auth::logout();
                return redirect()->route('auth.login')->withErrors(['email'=>'Akun anda telah Dibanned, Tolong hubungi Admin untuk tindakan lebih lanjut']);
            }   

            // switch ($user->role) {
            //     case 'admin':
            //         return redirect()->route('user.index');
            //     case 'guru':
            //         return redirect()->route('absensi.index');
            //     case 'siswa':
            //         return redirect()->route('profile.index');
            //     default: 
            //         return redirect()->route('welcome');
            // }

            return redirect('/');
        }
        return back()->withErrors(['email'=>'Email atau Password anda salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}