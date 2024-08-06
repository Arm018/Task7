<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $fields['email'])->first();

        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return response()->json([
                'message' => 'Wrong credentials'
            ], 401);
        }

        $admin->tokens()->delete();

        $token = $admin->createToken('access')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 60
        ]);
    }

    public function dashboard()
    {
        return response()->json([
            'dashboard_data' => 'some data'
        ]);
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
