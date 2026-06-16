<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login (redirect ke landing dengan modal)
     */
    public function show()
    {
        return redirect('/')->with('open_modal', 'login');
    }

    /**
     * Proses autentikasi login
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ─── REDIRECT BERDASARKAN ROLE ───
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        // Gagal login → balik ke landing dengan error
        return redirect('/')
            ->with('login_error', 'Email atau password salah.')
            ->with('open_modal', 'login');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout.');
    }
}