<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($request->email == 'admin@gmail.com' && $request->password == 'admin') {
            $request->session()->put('admin', $request->email);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['Invalid Email or Password']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('admin.index');
    }

    public function dashboard()
    {
        $admins = Admin::all();
        return view('admin.dashboard', compact('admins'));
    }
}
