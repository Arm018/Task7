<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        $admins = Admin::all();
        return view('admin.dashboard', compact('admins'));
    }
}
