<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('cari')) {
            $keyword = $request->cari;
        
            $statusValue = null;
            if (strtolower($keyword) == 'aktif') {
                $statusValue = 1;
            } elseif (strtolower($keyword) == 'dibanned') {
                $statusValue = 0;
            }
        
            $query->where(function ($q) use ($keyword, $statusValue) {
                $q->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('email', 'like', '%' . $keyword . '%')
                  ->orWhere('role', 'like', '%' . $keyword . '%');
        
                if (!is_null($statusValue)) {
                    $q->orWhere('status', $statusValue);
                }
            });
        }
        
        $users = $query->paginate(5)->appends($request->all());

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'status' => 'nullable|in:0,1',
            'role' => 'nullable|in:admin,guru,murid',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status ?? '1',
            'role' => $request->role ?? 'murid',
        ]);

        return redirect()->route('user.index')->with('success','Berhasil Tambah Data Pengguna');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $id,
            'password' => 'nullable|min:8',
            'status' => 'nullable|in:0,1',
            'role' => 'nullable|in:admin,guru,murid',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status ?? '1';
        $user->role = $request->role ?? 'murid';

        if($request->filled('password')){
            $user->password = bcrypt($request->password);
        }
        
        $user->save();
        return redirect()->route('user.index')->with('success','Berhasil Edit Data Pengguna');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success','Berhasil Hapus Data Pengguna');
    }
}
