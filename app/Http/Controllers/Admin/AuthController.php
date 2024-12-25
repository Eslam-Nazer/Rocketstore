<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Summary of adminLoginView
     * @return mixed|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function adminLoginView(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return redirect()->route('admin-dashboard');
        }
        return view('admin.auth.login');
    }

    /**
     * Summary of adminAuth
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminAuth(Request $request): RedirectResponse
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password,
            'is_admin'  => 1,
            'status'    => 0,
        ], $remember)) {
            return redirect()->route('admin-dashboard');
        }
        return redirect()->back()->with('error', 'Please enter correct email and password');
    }

    /**
     * Summary of adminLogout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminLogout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('admin-login');
    }
}
