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
        $admin = DB::table('admins')->where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Username atau password salah!');
        }

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
