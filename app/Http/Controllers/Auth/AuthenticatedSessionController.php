<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }   

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'login_failed' => 'Email atau password salah.',
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with ('succes', 'Kamu berhasil logout');
    }

    public function register() {
        return view('auth.register');
    }

    public function register_post(Request $request) {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:user,email_user',
            'notelp' => 'required',
            'password' => 'required|min:8'
        ]);

        $data['name'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['email'] = $request->email;
        $data['notelp'] = $request->notelp;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($login)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }   

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'login_failed' => 'Email atau password salah.',
        ]);
    }
}