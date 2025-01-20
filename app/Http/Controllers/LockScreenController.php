<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LockScreenController extends Controller
{
    public function showLockScreen()
    {
        // Simpan email user di sesi jika belum ada
        if (!session()->has('locked_email')) {
            session(['locked_email' => Auth::user()->email]);
        }

        // Logout user untuk mengunci sesi
        Auth::logout();

        return view('auth.lock-screen');
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::getProvider()->retrieveByCredentials(['email' => session('locked_email')]);

        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);
            session()->forget('locked_email');
            return redirect()->intended('/');
        }

        return back()->withErrors(['password' => 'Password is incorrect.']);
    }
}
