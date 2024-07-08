<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }


    public function login(Request $request) {
        $user = Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($user) {
            return response()->json([
                'status' => 'berhasil'
            ]);
        } else {
            return response()->json([
                'status' => 'gagal'
            ]);
        }
    }
}
