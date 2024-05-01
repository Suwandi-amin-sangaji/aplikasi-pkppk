<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login_sneat');
    }

    public function authenticated(Request $request, $user)
    {
        if (Auth::check() && $user->akses == 'admin') {
            return redirect()->route('admin.beranda');
        } elseif (Auth::check() && $user->akses == 'pimpinan') {
            return redirect()->route('pimpinan.beranda');
        } elseif (Auth::check() && $user->akses == 'petugas') {
            return redirect()->route('petugas.beranda');
        } else {
            Auth::logout();
            flash('Anda Tidak Memiliki Hak Akses')->error();
            return redirect()->route('login');
        }
    }
}