<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use voku\helper\AntiXSS;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $data = array(
            'title'             => 'Lapor',
            'menu'              => 'Login',
            'head'              => 'Login',
        );
        return view('auth/index')->with($data);
    }

    public function login(Request $request)
    {
        $validation = $request->validate([
            'username'        => 'required',
            'password'        => 'required',
        ]);
        $antiXss = new AntiXSS();
        
        $credentials = [
            'username' => $antiXss->xss_clean($request->input('username')),
            'password' => $antiXss->xss_clean($request->input('password'))
        ];
        
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user()->where('username', $request->input('username'))->first();
            $request->session()->put('user', $user);

            return redirect()->intended('/dashboard');
            
        } else {
            return redirect('/login')->with('error', 'Username atau Password Tidak Terdaftar.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('user');
        return redirect('/login');
    }
}
