<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $role = Auth::user()->role_id;
            // dd($role);
            if ($role == 1) {
                return redirect('/superadmin/dashboard');
            }

            if ($role == 2) {
                return redirect('/admin/dashboard');
            }

            if ($role == 3) {
                return redirect('/member/dashboard');
            }
        }

        return back()->with('error', 'Invalid Credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();


        return redirect('/');
    }
}
