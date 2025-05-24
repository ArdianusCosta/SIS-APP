<?php

namespace App\Http\Controllers;

use Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'old_password' => 'nullable|string|min:8', 
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan!');
        }

        \Log::info('Request data: ', $request->all());

        if ($request->filled('new_password')) {
            if (!$request->filled('old_password')) {
                return back()->withErrors(['old_password' => 'Password lama wajib diisi untuk mengubah password.']);
            }

            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama salah.']);
            }

            $user->password = Hash::make($request->new_password);
            \Log::info('Password baru yang di-hash: ' . $user->password);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('profile', 'public');
            $user->photo = $photoPath;
        }

        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        $user->save();
        \Log::info('User setelah disimpan: ', $user->fresh()->toArray());

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}