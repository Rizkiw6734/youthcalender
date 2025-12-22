<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login()
    {
        if (session()->has('admin_logged_in')) {
        return redirect()->route('admin.dashboard');
        }
        return response()
        ->view('admin.login')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

   public function loginPost(Request $request)
{
    // 1. Validasi input kosong
    if (!$request->username && !$request->password) {
        return back()->with('error', 'Username dan password wajib diisi!');
    }

    if (!$request->username) {
        return back()->with('error', 'Username wajib diisi!');
    }

    if (!$request->password) {
        return back()->with('error', 'Password wajib diisi!');
    }

    // 2. Cek admin berdasarkan username
    $admin = DB::table('admins')
        ->where('username', $request->username)
        ->first();

    // 3. Jika username tidak ditemukan atau password salah
    if (!$admin) {
        return back()->with('error', 'Username tidak terdaftar!');
    }

    if (!Hash::check($request->password, $admin->password)) {
        return back()->with('error', 'Password salah!');
    }

    // 4. Login sukses
    Session::put('admin_logged_in', true);
    Session::put('admin_username', $admin->username);

    return redirect()->route('admin.dashboard');
}

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login');
    }
}
