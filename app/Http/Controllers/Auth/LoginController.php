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
                return redirect()->route('auth.login')->withErrors(['email'=>'Akun anda telah dibanned. Hubungi Admin untuk bantuan lebih lanjut.']);
            }   

            return redirect('/')->with('success','Selamat Datang di SIS-APP');
        }
        return back()->withErrors(['email'=>'Email atau Password anda salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}