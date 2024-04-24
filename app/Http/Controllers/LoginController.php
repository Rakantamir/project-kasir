<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/home');
        } else {
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        // Dapatkan email dan password dari request
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek apakah pengguna ada di database
        $user = User::where('email', $email)->first();

        // Jika pengguna ada dan password cocok
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user); // Login pengguna
            return redirect('/home');
        } else {
            // Jika email atau password tidak cocok, tampilkan pesan kesalahan
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
