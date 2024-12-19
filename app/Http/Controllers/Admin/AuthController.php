<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function adminLoginView()
    {
        if (Auth::check() && Auth::user()->IsAdmin == 1) {
            return redirect()->route('admin-dashboard');
        }
        return view('admin.auth.login');
    }

    /**
     * Summary of adminAuth
     * @param \Illuminate\Http\Request $request
     */
    public function adminAuth(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password,
            'IsAdmin'   => 1
        ], $remember)) {
            return redirect()->route('admin-dashboard');
        }
        return redirect()->back()->with('error', 'Please enter correct email and password');
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('admin-login');
    }
}
